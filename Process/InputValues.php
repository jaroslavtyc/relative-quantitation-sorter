<?php
namespace RqData\Process;

use RqData\Registry\Errors;
use \RqData\Process\Settings;
use RqData\RequiredSettings\File\FileWithData;

class InputValues extends Base {

	const FIRST_ROW_CONTAINS_HEADER = TRUE;
	const KEEP_USER_RESOURCE_FILE = TRUE;

	protected $inputHeader;
	protected $uploadedFile;
	protected $inputData;
	protected $timeTempnameKey;
	protected $inputFile;
	protected $settings;

	public function __construct(InputFile $inputFile, Settings $settings, Errors $errors) {
		parent::__construct($errors);
		$this->inputFile = $inputFile;
		$this->settings = $settings;
	}

	public function process() {
		$this->getInputFile()->process();
		$this->getSettings()->process();
		$this->calculateInputData();
		$this->manageResourceFileHistory();
	}

	public function getInputHeader() {
		return $this->inputHeader;
	}

	public function getInputData() {
		return $this->inputData;
	}

	public function getTimeTempnameKey() {
		return $this->timeTempnameKey;
	}

	public function getColumnsPurpose() {
		return $this->getSettings()->getColumnsPurpose();
	}

	public function getExtendingSettings() {
		return $this->getSettings()->getExtendingSettings();
	}

	/**
	 * @return InputFile
	 */
	protected function getInputFile() {
		return $this->inputFile;
	}

	/**
	 * @return Settings
	 */
	protected function getSettings() {
		return $this->settings;
	}

	/**
	 * Loads data from file, check format of data and validate them
	 *
	 * @return bool
	 */
	private function calculateInputData() {
		$this->inputValuesSetRawData();
		$this->explodeRowsToCells();
		$this->separateHeader();
		$this->validateValues();
	}

	private function manageResourceFileHistory() {
		$this->setTimeTempnameKey();
		if (self::KEEP_USER_RESOURCE_FILE) {
			if (empty($_FILES[FileWithData::FILE_NAME]['tmp_name'])) {
				throw new Exception('No file to save');
			}

			if (!$this->getInputFile()->getUploadedFile()->copyTo(
				\RqData\History\FileUtilities::getUserResourceFileFolderPath(),
				$this->timeTempnameKey . '_' . $this->getInputFile()->getUploadedFile()->size . '_' . $this->getInputFile()->getUploadedFile()->name
			)) {
				$this->getErrors()->zapamatujChybu('Nezdařilo se uložit nahraný soubor', 'Historie');

				return FALSE;
			}
		}

		return TRUE;
	}

	private function inputValuesSetRawData() {
		$this->inputData = $this->getInputFile()->getUploadedFile()->getContentArray();
		if (!$this->inputData) {
			$this->getErrors()->zapamatujChybu('je prázdný', 'Soubor');
			throw new InputFileIsEmpty;
		}
	}

	private function separateHeader() {
		if (sizeof($this->inputData) == 0) {
			throw new Exception('Raw data are empty');
		}
		if (self::FIRST_ROW_CONTAINS_HEADER) {
			//first row should contains header description
			reset($this->inputData);
			if (sizeof(current($this->inputData)) !=
					  $this->getColumnsPurpose()->getNumberOfColumns()) {
				throw new Exception('Invalid header row format');
			}
			$this->inputHeader = current($this->inputData);
			unset($this->inputData[key($this->inputData)]);
		}
	}

	private function explodeRowsToCells() {
		$numberOfColumns = $this->getColumnsPurpose()->getNumberOfColumns();
		foreach ($this->inputData as $rowIndex => &$row) {
			if (empty($row)) {
				unset($this->inputData[$rowIndex]);
				continue;
			}
			$row = explode("\t", $row); //split row to items
			if (sizeof($row) < $numberOfColumns) {
				$this->getErrors()->zapamatujChybu(sprintf(
									 'chybný (%s)', (sizeof($row) > 1) ? sprintf('málo sloupců (%d) na řádku %d, požadováno %d', sizeof($row), $rowIndex + 1, $numberOfColumns) : 'nenalezen oddělovač tabulátor'
						  ), 'Formát souboru'
				);
				throw new WrongInputFileFormat;
			}
			if (sizeof($row) > $numberOfColumns) { //if number of given row parts
				// is greater then required
				foreach ($row as $tierOfItem => $item) {
					if ($tierOfItem >= ColumnsPurpose::getNumberOfPossibleColumns() && trim($item) !== '') {
						$this->getErrors()->zapamatujChybu(sprintf(
											 'chybný; na řádku %d zjištěno příliš mnoho sloupců', $rowIndex
								  ), 'Formát souboru'
						);
						throw new WrongInputFileFormat;
					}
				}
				$row = array_slice($row, 0, $numberOfColumns); //removing extra row parts
			}
		}
	}

	private function validateValues() {
		foreach ($this->inputData as $rowIndex => &$row) {
			foreach ($row as $itemIndex => &$item) {
				if (!$this->getColumnsPurpose()->isColumnNumeric($itemIndex)) {
					if ($item === '') {
						//empty name of subject or gene - row is unusable
						unset($this->inputData[$rowIndex]);
						break;
					}
				} else {
					$item = str_replace(',', '.', $item);
				}
			}
		}
	}

	/**
	 * Setter for identificator of working files
	 */
	private function setTimeTempnameKey() {
		$this->timeTempnameKey = time() . '_' .  str_replace('_', '', $this->getInputFile()->getUploadedFile()->tmpFilename);
	}
}

class InputFileIsMissing extends \RqData\Debugging\UserException {

}

class InputFileIsEmpty extends \RqData\Debugging\UserException {

}

class WrongInputFileFormat extends \RqData\Debugging\UserException {

}
