<?php
namespace RqData\Process;

use RqData\Registry\Errors;
use RqData\History\FileUtilities;
use RqData\OptionalSettings\Registry\MeasurementSettings;

class Result extends Base {

	const KEEP_USER_RESULT_FILE = TRUE;
	const BASE_RESULT_FILENAME = 'rqData';
	const RESULT_FILENAME_SUFFIX = 'xls';
	const ADD_DATE_TO_RESULT_FILENAME = TRUE;
	const LEGEND_BACKGROUND_COLOR = '#0554FF';
	const CALIBRATOR_BACKGROUND_COLOR = '#FFFF00'; // yellow
	const REFERENCE_GENE_COLOR = '#AFFC00';

	private $format;
	protected $resultFile;
	protected $resultFilename;
	protected $userFileBasename;

	public function __construct(Format $format, Errors $errors) {
		parent::__construct($errors);
		$this->format = $format;
	}

	public function process() {
		$this->getFormat()->process();
		$this->saveDataToFile($this->getResultXlsData(), $this->getResultFilename());
		$this->setResultFile($this->getResultFilename());
		if (self::KEEP_USER_RESULT_FILE) {
			$this->saveResultFileToHistory();
		}
	}

	public function getUserFileBasename() {
		if (!isset($this->userFileBasename)) {
			$this->userFileBasename = $this->createUserFileBasename();
		}
		return $this->userFileBasename;
	}

	protected function createUserFileBasename() {
		$fileName = self::BASE_RESULT_FILENAME;
		if (self::ADD_DATE_TO_RESULT_FILENAME) {
			$fileName .= date('_j_n_Y H-i-s');
		}
		$fileName .= '.' . self::RESULT_FILENAME_SUFFIX;
		return $fileName;
	}

	protected function getResultFilename() {
		if (!isset($this->resultFilename)) {
			$this->resultFilename = tempnam(sys_get_temp_dir(), $this->getUserFileBasename());
		}
		return $this->resultFilename;
	}

	protected function saveDataToFile(\universal\Folder\File\Xls\HtmlXlsFile $htmlXls, $filename) {
		if (!($handle = fopen($filename,'w+'))) {
			throw new Exception('Nelze založit dočasný soubor pro uložení výsledku');
		} elseif (!fwrite($handle, $htmlXls->getTable())) {
			throw new Exception('Nelze zapsat do dočasného souboru pro uložení výsledku');
		}
		fclose($handle);
	}

	protected function setResultFile($filename) {
		$this->resultFile = new \universal\Folder\File\File($filename);
	}

	/**
	 * @return Format
	 */
	protected function getFormat() {
		return $this->format;
	}

	public function getFilename() {
		return $this->getResultFilename();
	}

	protected function saveResultFileToHistory() {
		$resultFinalName = $this->getFormat()->getTimeTempnameKey() . '_' . $this->getResultFile()->size . '_' . $this->getResultFile()->name;
		if (!$this->getResultFile()->copyTo(FileUtilities::getUserResultFileFolderPath(), $resultFinalName)) {
			$this->getErrors()->zapamatujChybu('Nelze přesunout dočasný soubor s uloženým výsledem pro zachování v historii', 'Výsledný soubor');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * @return \File
	 */
	protected function getResultFile() {
		return $this->resultFile;
	}

	/**
	 * Now in sortedData are values formed as
	 * list of [subject name] => each pointing to list of [gene name] =>
	 * each pointing to list of [(ct value, rq value)] pairs
	 *
	 * @return \universal\Folder\File\Xls\HtmlXlsFile
	 */
	protected function getResultXlsData() {
		$xls = new \universal\Folder\File\Xls\HtmlXlsFile();
		$this->addHeaderToResult($xls);
		$this->addBodyToResult($xls);
		$this->addLegend($xls);
		return $xls;
	}

	protected function addHeaderToResult(\universal\Folder\File\Xls\HtmlXlsFile $xls) {
		$xls->addRow(new \universal\Folder\File\Xls\HtmlXlsRow($this->getHeaderRow()));
		$xls->moveFirstRowAsHeader();
	}

	protected function getHeaderRow() {
		$header = $this->getFormat()->getFormedHeader();
		$headerRow = array();
		$nameOfSubjectNameColumn = $header[\RqData\RequiredSettings\Options\ColumnsPurpose::SUBJECT_NAME];
		$nameOfCtDataColumn = $header[\RqData\RequiredSettings\Options\ColumnsPurpose::CT_VALUES];
		$nameOfRqDataColumn = $header[\RqData\RequiredSettings\Options\ColumnsPurpose::RQ_VALUES];
		$headerRow[] = '<b>' . htmlspecialchars($nameOfSubjectNameColumn) . '</b>';
		$extendingSettings = $this->getFormat()->getExtendingSettings();
		foreach ($this->getFormat()->getListOfGeneNames() as $geneName) {
			if (in_array($geneName, $extendingSettings['referenceGenes'])) {
				$geneNameRq = sprintf(
					'<span COLOR="%s">%s</span>',
					self::REFERENCE_GENE_COLOR,
					htmlspecialchars($geneName . ' - ' . $nameOfRqDataColumn)
				);
				$geneNameCt = sprintf(
					'<span COLOR="%s">%s</span>',
					self::REFERENCE_GENE_COLOR,
					htmlspecialchars($geneName . ' - ' . $nameOfCtDataColumn)
				);
			} else {
				$geneNameRq = htmlspecialchars($geneName . ' - ' . $nameOfRqDataColumn);
				$geneNameCt = htmlspecialchars($geneName . ' - ' . $nameOfCtDataColumn);
			}
			$headerRow[] = '<b>' . $geneNameRq . '</b>';
			$headerRow[] = '<b>' . $geneNameCt . '</b>';
		}
		return $headerRow;
	}

	protected function addBodyToResult(\universal\Folder\File\Xls\HtmlXlsFile $xls) {
		foreach ($this->getFormat()->getFormedData() as $subjectName => $subjectValues) {
			$this->addRowToResultBody($xls, $subjectName, $subjectValues);
		}
	}

	protected function addRowToResultBody(\universal\Folder\File\Xls\HtmlXlsFile $xls, $subjectName, $subjectValues) {
		$resultRow = array();
		$resultRow[] = htmlspecialchars($subjectName);
		foreach ($this->getFormat()->getListOfGeneNames() as $geneName) {
			if (isset($subjectValues[$geneName][\RqData\RequiredSettings\Options\ColumnsPurpose::CT_VALUES])) {
				$resultRow[] = htmlspecialchars($subjectValues[$geneName][\RqData\RequiredSettings\Options\ColumnsPurpose::CT_VALUES]);
			} else {
				$resultRow[] = '';
			}
			if (isset($subjectValues[$geneName][\RqData\RequiredSettings\Options\ColumnsPurpose::RQ_VALUES])) {
				$resultRow[] = htmlspecialchars($subjectValues[$geneName][\RqData\RequiredSettings\Options\ColumnsPurpose::RQ_VALUES]);
			} else {
				$resultRow[] = '';
			}
		}
		$row = new \universal\Folder\File\Xls\HtmlXlsRow($resultRow);
		if ($this->getFormat()->getNameOfCalibrator() == $subjectName) {
			$row->setBgcolor(self::CALIBRATOR_BACKGROUND_COLOR);
		}
		$xls->addRow($row);
	}

	protected function addLegend(\universal\Folder\File\Xls\HtmlXlsFile $xls) {
		$extendingSettings = $this->getFormat()->getExtendingSettings();
		if (!empty($extendingSettings['referenceGenes'])) {
			$this->addReferenceGenesLegend($xls, $extendingSettings['referenceGenes']);
		}
		if (!empty($this->optionalSettings[MeasurementSettings::CODE])) {
			$this->addMeasurementSettingsToKeepLegend($xls, $this->optionalSettings[MeasurementSettings::CODE]);
		}
	}

	protected function addReferenceGenesLegend(\universal\Folder\File\Xls\HtmlXlsFile $xls, $referenceGenes) {
		$footerData = array();
		$footerData[] = '<h3>Referenční geny</h3>';
		$footerData[] = '<ul>';
		foreach ($referenceGenes as $referenceGene) {
			$footerData[] = sprintf('<li>%s</li>', htmlspecialchars($referenceGene));
		}
		$footerRow = new \universal\Folder\File\Xls\HtmlXlsRow($footerData);
		$footerRow->setBgcolor(self::LEGEND_BACKGROUND_COLOR);
		$xls->addRow($footerRow);
		$xls->moveLastRowAsFooter();
	}

	protected function addMeasurementSettingsToKeepLegend(\universal\Folder\File\Xls\HtmlXlsFile $xls, $settingsToKeep) {
		$footerData = array();
		$possibleMeauserments = array();
		foreach (new \MeasurementSettings as $possibleMeauserment) {
			$possibleMeauserments[$possibleMeauserment->code] = $possibleMeauserment;
		}
		foreach ($settingsToKeep as $code => $meausermentSetting) {
			$footerData[] = '<i>' .	\htmlspecialchars($possibleMeauserments[$code]->humanName) . ': ' . '</i>';
			$footerData[] = '<i>' .	\htmlspecialchars($meausermentSetting) . '</i>';
		}
		$footerRow = new \universal\Folder\File\Xls\HtmlXlsRow($footerData);
		$footerRow->setBgcolor(self::LEGEND_BACKGROUND_COLOR);
		$xls->addRow($footerRow);
		$xls->moveLastRowAsFooter();
	}
}