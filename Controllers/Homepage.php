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
		return new \ConsequencesOfMaximalCtValue;
	}

	protected function getMeasurements() {
		return new \MeasurementSettingsToKeep;
	}

	protected function getFormStateHolder() {
		return new \RqData\Registry\FormStateKeeper();
	}
}