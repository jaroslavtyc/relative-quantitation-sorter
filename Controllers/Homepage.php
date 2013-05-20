<?php
namespace RqData\Controllers;

class Homepage extends DisplayWithErrorMessages {

	protected function setUpView() {
		$this->setUpValuesToView();
		$this->setUpTemplatesToView();
	}

	protected function render() {
		$this->getViewer()->display('index.tpl');
	}

	protected function setUpValuesToView() {
		parent::setUpValuesToView();
		$this->getViewer()->assign('formStatesHistory', $this->getFormStateHolder());
		$this->getViewer()->assign('operationList', $this->getOperationList());
		$this->getViewer()->assign('consequence', $this->getConsequence());
		$this->getViewer()->assign('measurementSettings', $this->getMeasurements());
		$this->getViewer()->assign('inputFileName', \RqData\RequiredSettings\File\FileWithData::FILE_NAME);
		$this->getViewer()->assign('maximalCtValueConsequencesCode', \RqData\OptionalSettings\Consequences\Settings\MaximalCtValue::CODE);
		$this->getViewer()->assign('maximalCtValueConsequencesName', \RqData\OptionalSettings\Consequences\Settings\MaximalCtValue::HUMAN_NAME);
		$this->getViewer()->assign('measurementSettingsRegistryCode', \RqData\OptionalSettings\Registry\MeasurementSettings::CODE);
		$this->getViewer()->assign('measurementSettingsRegistryName', \RqData\OptionalSettings\Registry\MeasurementSettings::HUMAN_NAME);
	}

	protected function setUpTemplatesToView() {
		$this->getViewer()->assign('css', array('main.css', 'opentip.css'));
		$this->getViewer()->assign(
			'headerJs',
			array('libraries/jquery.js', 'libraries/jquery.formautofill.min.js', 'libraries/opentip-jquery.min.js')
		);
	}

	protected function getOperationList() {
		return new \RqData\RequiredSettings\Options\OperationList;
	}

	protected function getConsequence() {
		return new \RqData\OptionalSettings\Consequences\MaximalCtValue;
	}

	protected function getMeasurements() {
		return new \RqData\OptionalSettings\Registry\MeasurementSettings;
	}

	protected function getFormStateHolder() {
		return new \RqData\Registry\FormStateKeeper();
	}
}