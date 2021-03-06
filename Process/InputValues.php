<?php
namespace RqData\Process;

use RqData\Registry\UserErrors;
use RqData\Process\Settings;
use RqData\RequiredSettings\File\WithData;
use RqData\Process\Exceptions\EmptyInputFile;
use RqData\Process\Exceptions\WrongInputFileFormat;

class InputValues extends Base {
	const FIRST_ROW_CONTAINS_HEADER = TRUE;
	const KEEP_USER_RESOURCE_FILE = TRUE;

	protected $inputHeader;
	protected $uploadedFile;
	protected $inputData;
	protected $timeTempnameKey;
	protected $inputFile;
	protected $settings;

	public function __construct(InputFile $inputFile, Settings $settings, UserErrors $errors) {
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

	public function getOptionalSettings() {
		return $this->getSettings()->getOptionalSettings();
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
			if (empty($_FILES[WithData::FILE_NAME]['tmp_name'])) {
				throw new Exception('No file to save');
			}

			if (!$this->getInputFile()->moveTo(sprintf('%s%s_%s_%s', \RqData\History\FileUtilities::getUserResourceFileFolderPath(), $this->timeTempnameKey, $this->getInputFile()->getSize(), $this->getInputFile()->getName()))
			) {
				$this->getErrors()->rememberError('Nezdařilo se uložit nahraný soubor', 'Historie');

				return FALSE;
			}
		}

		return TRUE;
	}

	private function inputValuesSetRawData() {
		$this->inputData = $this->getInputFile()->getContentArray();
		if (!$this->inputData) {
			$this->getErrors()->rememberError('je prázdný', 'Soubor');
			throw new EmptyInputFile;
		}
	}

	private function separateHeader() {
		if (count($this->inputData) == 0) {
			throw new Exception('Raw data are empty');
		}
		if (self::FIRST_ROW_CONTAINS_HEADER) {
			//first row should contains header description
			reset($this->inputData);
			if (count(current($this->inputData)) !=
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
			if (count($row) < $numberOfColumns) {
				$this->getErrors()->rememberError(sprintf(
									 'chybný (%s)', (count($row) > 1) ? sprintf('málo sloupců (%d) na řádku %d, požadováno %d', count($row), $rowIndex + 1, $numberOfColumns) : 'nenalezen oddělovač tabulátor'
						  ), 'Formát souboru'
				);
				throw new WrongInputFileFormat;
			}
			if (count($row) > $numberOfColumns) { //if number of given row parts
				// is greater then required
				foreach ($row as $tierOfItem => $item) {
					if ($tierOfItem >= ColumnsPurpose::getNumberOfPossibleColumns() && trim($item) !== '') {
						$this->getErrors()->rememberError(sprintf(
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
		$this->timeTempnameKey = time() . '_' .  str_replace('_', '', $this->getInputFile()->getTempFilename());
	}
}