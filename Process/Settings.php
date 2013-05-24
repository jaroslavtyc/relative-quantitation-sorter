<?php
namespace RqData\Process;

use RqData\Registry\Errors;

class Settings extends Base {

	const COUNT_CONSEQUENCES_OF_CT_MAXIMUM = TRUE;

	protected $columnsPurpose;
	protected $operationList;
	protected $optionalSettings;
	protected $extendingSettings = array();
	protected $inputSettings;

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
		$this->setOptionalSettings();
		$this->setSettings();
	}

	public function getExtendingSettings() {
		return $this->extendingSettings;
	}

	protected function checkOperationToProcess() {
		$this->checkIfOpreationIsSet();
		$this->checkChoosenOperation();
	}

	protected function checkIfOpreationIsSet() {
		if (!$this->getInputSettings()->offsetExists('operation')
			|| ((string) $this->getInputSettings()->offsetGet('operation') === '')
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

	protected function setSettings() {
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
		}
	}

	protected function alterExtendingSettings(\RqData\RequiredSettings\File\ExtendingOptions $extendingSetting) {
		switch ($extendingSetting->code) {
			case \RqData\RequiredSettings\File\ReferenceGenes::CODE :
				$this->alterExtendingSettingsReferenceGenes($extendingSetting);
				break;
			case \RqData\RequiredSettings\File\Calibrator::CODE :
				$this->alterExtendingSettingsCalibrator($extendingSetting);
				break;
			default:
				throw new UnknownEffectOfGivenExtendingSetting($extendingSetting->code);
		}
	}

	protected function alterExtendingSettingsCalibrator(\RqData\RequiredSettings\File\ExtendingOptions $extendingSetting) {
		$this->extendingSettings['calibrator'] = trim($this->getInputSettingsValue($extendingSetting->code));
	}

	protected function alterExtendingSettingsReferenceGenes(\RqData\RequiredSettings\File\ExtendingOptions $extendingSetting) {
		$referenceGenes =	explode(\RqData\RequiredSettings\File\ReferenceGenesSeparator::VALUE, $this->getInputSettingsValue($extendingSetting->code));
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

	protected function setOptionalSettings() {
		$this->optionalSettings = array();
		$optionalSettings = $this->getInputSettings()->offsetGet('optional');
		$errorCounter = 0;
		try {
			if (self::COUNT_CONSEQUENCES_OF_CT_MAXIMUM) {
				$this->countConsequencesOfCtMaximum($optionalSettings);
			}
		} catch (\RqData\Debugging\UserException $userException) {
			$errorCounter++;
		}
		try {
			$this->setOptionalSettingsToKeep($optionalSettings);
		} catch (\RqData\Debugging\UserException $userException) {
			$errorCounter++;
		}
		if ($errorCounter > 0) {
			throw new CheckingOptionalSettingsFails;
		}
	}

	protected function setOptionalSettingsToKeep($optionalSettings) {
		$mainCode = \RqData\OptionalSettings\Registry\MeasurementSettings::CODE;
		$this->optionalSettings[$mainCode] = array();
		if (!empty($optionalSettings[$mainCode])) {
			$givenSettings = $optionalSettings[$mainCode];
			foreach ($this->getMeausermentSettings() as $meausermentSetting) {
				if (isset($givenSettings[$meausermentSetting->code])) {
					if ($givenSettings[$meausermentSetting->code] !== '') {
						$this->optionalSettings[$mainCode][$meausermentSetting->code] = $givenSettings[$meausermentSetting->code];
					}
				}
			}
		}
	}

	/**
	 * @return \RqData\OptionalSettings\Registry\MeasurementSettings
	 */
	protected function getMeausermentSettings() {
		return new \RqData\OptionalSettings\Registry\MeasurementSettings;
	}

	protected function countConsequencesOfCtMaximum($optionalSettings) {
		$failureCount = 0;
		foreach ($this->getMaximalCtValueSettingsOfConsequences() as $settingOfConsequence) {
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

	protected function countConsquenceOfCtMaximum($optionalSettings, $settingOfConsequence) {
		if (!isset($optionalSettings[$settingOfConsequence->code])) {
			$this->getErrors()->zapamatujChybu('Chybí ' . $settingOfConsequence->humanName, \RqData\OptionalSettings\Consequences\MaximalCtValueSettings::HUMAN_NAME);
			throw new MissingConsequenceForCtMaximumValue($settingOfConsequence->code);
		} else {
			$consequenceValue = str_replace(',', '.', $optionalSettings[$settingOfConsequence->code]);
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

	/**
	 * @return \RqData\OptionalSettings\Consequences\MaximalCtValueSettings
	 */
	protected function getMaximalCtValueSettingsOfConsequences() {
		return new \RqData\OptionalSettings\Consequences\MaximalCtValueSettings;
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