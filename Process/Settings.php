<?php
namespace RqData\Process;

use RqData\Registry\Errors;

class Settings extends Base {

	const COUNT_CONSEQUENCES_OF_CT_MAXIMUM = TRUE;

	private $columnsPurpose;
	private $operationList;
	private $optionalSettings;
	private $extendingSettings = array();
	private $inputSettings;

	public function __construct(\ArrayAccess $inputSettings, Errors $errors) {
		parent::__construct($errors);
		$this->setInputSettings($inputSettings);
	}

	protected function setInputSettings($settings) {
		$this->inputSettings = $settings;
	}

	/**
	 * @return \ArrayAccess
	 */
	protected function getInputSettings() {
		return $this->inputSettings;
	}

	public function process() {
		$this->checkOperationToProcess();
		$this->setOptions();
		$this->checkOptionalSettings();
	}

	protected function checkOperationToProcess() {
		$this->checkIfOpreationIsSet();
		$this->checkChoosenOperation();
	}

	protected function checkIfOpreationIsSet() {
		if (!$this->getInputSettings()->offsetExists('operation')
			|| (bool) $this->getInputSettings()->offsetGet('operation') === false
		) {
			$this->getErrors()->zapamatujChybu('chybí','Určení obsahu souboru');
			throw new NoOperationIsChoosen;
		}
	}

	protected function checkChoosenOperation() {
		if (!$this->getOperationList()->isOperation($this->getInputSettings()->offsetGet('operation'))) {
			throw new UnknownChoosenOperationCode($this->getInputSettings()->offsetGet('operation'));
		}
	}

	protected function setOptions() {
		$operation = $this->getRequiredOperation();
		$errorCounter = 0;
		foreach ($operation->getListOfExtendingSettings() as $extendingSetting) {
			try {
				$this->checkGivenExtendingSettings($extendingSetting);
				$this->alterExtendingSettings($extendingSetting);
			} catch (\RqData\Debugging\UserException $userException) {
				$errorCounter++;
			}
		}
		if ($errorCounter > 0) {
			throw new SettingUpByInputSettingsFail($errorCounter);
		} else {
			$this->filterUsedInputSettings();
		}
	}

	protected function filterUsedInputSettings() {
		$this->getInputSettings()->offsetUnset(ReferenceGenes::CODE);
		$this->getInputSettings()->offsetUnset(Calibrator::CODE);
		$this->getInputSettings()->offsetUnset('operation');
	}

	protected function alterExtendingSettings(\ExtendingOptions $extendingSetting) {
		switch ($extendingSetting->code) {
			case ReferenceGenes::CODE :
				$this->alterExtendingSettingsReferenceGenes($extendingSetting);
				break;
			case Calibrator::CODE :
				$this->alterExtendingSettingsCalibrator($extendingSetting);
				break;
			default:
				throw new UnknownEffectOfGivenExtendingSetting($extendingSetting->code);
		}
	}

	protected function alterExtendingSettingsCalibrator(\ExtendingOptions $extendingSetting) {
		$this->extendingSettings['calibrator'] = trim($this->getInputSettingsValue($extendingSetting->code));
	}

	protected function alterExtendingSettingsReferenceGenes(\ExtendingOptions $extendingSetting) {
		$referenceGenes =	explode(ReferenceGenesSeparator::VALUE, $this->getInputSettingsValue($extendingSetting->code));
		foreach ($referenceGenes as $index => $referenceGene) {
			$referenceGenes[$index] = trim($referenceGene);
		}
		$this->extendingSettings['referenceGenes'] = $referenceGenes;
	}

	protected function checkGivenExtendingSettings(\RqData\RequiredSettings\File\ExtendingOptions $extendingSetting) {
		if (!$this->getInputSettings()->offsetExists($extendingSetting->code)) {
			throw new MissingExtendingSettings(sprintf('Setting code [%s]', $extendingSetting->code));
		} elseif (!$this->getInputSettings()->offsetExists($extendingSetting->code)
			|| (string) $this->getInputSettings()->offsetGet($extendingSetting->code) === ''
		) {
			$this->getErrors()->zapamatujChybu('nevyplněno', $extendingSetting->humanName);
			throw new UnfilledExtendingSettings($extendingSetting->code);
		}
	}

	protected function getInputSettingsValue($name) {
		if ($this->getInputSettings()->offsetExists($name)) {
			return $this->getInputSettings()->offsetGet($name);
		} else {
			throw new \Exception(sprintf('Value of name [%s] is missing in input settings', $name));
		}
	}

	/**
	 * @return \RqData\RequiredSettings\Options\ColumnsPurpose
	 */
	public function getColumnsPurpose() {
		if (!isset($this->columnsPurpose)) {
			$this->columnsPurpose = new \RqData\RequiredSettings\Options\ColumnsPurpose($this->getInputSettingsValue('operation'));
		}
		return $this->columnsPurpose;
	}

	/**
	 * @return RqData\RequiredSettings\Options\OperationList
	 */
	protected function getOperationList() {
		if (!isset($this->operationList)) {
			$this->operationList = new \RqData\RequiredSettings\Options\OperationList;
		}
		return $this->operationList;
	}

	protected function getRequiredOperation() {
		return $this->getOperationList()->getOperation($this->getInputSettingsValue('operation'));
	}

	protected function checkOptionalSettings() {
		$this->optionalSettings = array();
		$optionalSettings = $this->inputSettings;
		$errorCounter = 0;
		try {
			$this->checkConsequencesOfMaximum($optionalSettings);
		} catch (\RqData\Debugging\UserException $userException) {
			$errorCounter++;
		}
		try {
			$this->setOptionalSettingsToKeep($optionalSettings);
		} catch (\RqData\Debugging\UserException $userException) {
			$errorCounter++;
		}
		try {
			$this->checkAdditionalFormatingSettings($optionalSettings);
		} catch (\RqData\Debugging\UserException $userException) {
			$errorCounter++;
		}
		if ($errorCounter > 0) {
			throw new CheckingOptionalSettingsFails;
		} else {
			$this->optionalSettings = array_merge($this->optionalSettings, $optionalSettings);
			return TRUE;
		}
	}

	protected function checkConsequencesOfMaximum(&$optionalSettings) {
		$userException = FALSE;
		if (self::COUNT_CONSEQUENCES_OF_CT_MAXIMUM) {
			try {
				$this->countConsquencesOfCtMaximum($optionalSettings);
			} catch (\RqData\Debugging\UserException $userException) {
			}
			if (isset($this->inputSettings[ConsequencesOfMaximalCtValue::CODE])) {
				unset($this->inputSettings[ConsequencesOfMaximalCtValue::CODE]);
			}
		}
		if ($userException) {
			throw new $userException;
		}
	}

	protected function setOptionalSettingsToKeep(&$optionalSettings) {
		if (!empty($optionalSettings[MeasurementSettingsToKeep::CODE])) {
			$this->optionalSettings[MeasurementSettingsToKeep::CODE] = array();
			$measurementSettingsToSet = &$this->optionalSettings[MeasurementSettingsToKeep::CODE];
			$givenMeauserementSettings = &$optionalSettings[MeasurementSettingsToKeep::CODE];
			$meausermentSettings = new \MeasurementSettingsToKeep;
			foreach ($meausermentSettings as $meausermentSetting) {
				if (isset($givenMeauserementSettings[$meausermentSetting->code])) {
					if ($givenMeauserementSettings[$meausermentSetting->code] !== '') {
						$measurementSettingsToSet[$meausermentSetting->code] =
							$givenMeauserementSettings[$meausermentSetting->code];
					}
				}
			}
			unset($optionalSettings[MeasurementSettingsToKeep::CODE]);
		}
	}

	protected function checkAdditionalFormatingSettings($optionalSettings) {
		$correct = TRUE;
		foreach (array_keys($optionalSettings) as $dodatkoveNastaveni) {
			switch($dodatkoveNastaveni){
				case 'smazaniJmenLidi':
					break;
				case 'presunNazvuGenuDoHlavicky':
					break;
				case 'pridaniZkratekObsahuDoHlavickyGenu':
					break;
				default:
					$this->getErrors()->zapamatujChybu($dodatkoveNastaveni, 'Neznámé dodatkové nastavení');
					$correct = FALSE;
			}
		}
		if (!$correct) {
			throw new UnknownAdditionalFormatingSettings;
		}
	}

	protected function countConsquencesOfCtMaximum(&$optionalSettings) {
		$failureCount = 0;
		foreach ($this->getConsequencesOfMaximalCtValue() as $settingOfConsequence) {
			try {
				$this->countConsquenceOfCtMaximum($optionalSettings, $settingOfConsequence);
			} catch (\RqData\Debugging\UserException $userException) {
				$failureCount++;
			}
		}
		if ($failureCount > 0) {
			throw new CountingConsquencesOfCtMaximumFails(sprintf('%d× times', $failureCount));
		}
	}

	protected function countConsquenceOfCtMaximum(&$optionalSettings, $settingOfConsequence) {
		if (!isset($optionalSettings[$settingOfConsequence->code])) {
			$this->getErrors()->zapamatujChybu('Chybí ' . $settingOfConsequence->humanName, ConsequencesOfMaximalCtValue::HUMAN_NAME);
			throw new MissingConsequenceForCtMaximumValue($settingOfConsequence->code);
		} else {
			$consequenceValue = str_replace(',', '.', $optionalSettings[$settingOfConsequence->code]);
			unset($optionalSettings[$settingOfConsequence->code]);
			if (!preg_match('~^([\d]+([.\d]+)?)?$~', $consequenceValue)) {
				$this->getErrors()->zapamatujChybu($settingOfConsequence->humanName . ' musí být číslo', 'Chybný formát');
				throw new WrongFormatOfConsequenceValueForCtMaximumValue(sprintf(
					'code: [%s], value: [%s]', $settingOfConsequence->code, $consequenceValue)
				);
			} else {
				$this->optionalSettings[$settingOfConsequence->code] = $consequenceValue;
			}
		}
	}

	protected function getConsequencesOfMaximalCtValue() {
		return new \ConsequencesOfMaximalCtValue;
	}
}

class NoOperationIsChoosen extends \RqData\Debugging\UserException {}
class UnfilledExtendingSettings extends \RqData\Debugging\UserException {}
class SettingUpByInputSettingsFail extends \RqData\Debugging\UserException {}
class MissingConsequenceForCtMaximumValue extends \RqData\Debugging\UserException {}
class WrongFormatOfConsequenceValueForCtMaximumValue extends \RqData\Debugging\UserException {}
class CountingConsquencesOfCtMaximumFails extends \RqData\Debugging\UserException {}
class UnknownAdditionalFormatingSettings extends \RqData\Debugging\UserException {}
class CheckingOptionalSettingsFails extends \RqData\Debugging\UserException {}

class UnknownChoosenOperationCode extends \RqData\Debugging\CoreException {}
class MissingExtendingSettings extends \RqData\Debugging\CoreException {}
class UnknownEffectOfGivenExtendingSetting extends \RqData\Debugging\CoreException {}