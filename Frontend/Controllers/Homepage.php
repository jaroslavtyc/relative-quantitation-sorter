<?php
namespace RqData\Frontend\Controllers;

use \RqData\RequiredSettings\Options\OperationList;
use \RqData\OptionalSettings\Consequences\MaximalCtValueSettings;
use \RqData\OptionalSettings\Registry\MeasurementSettings;
use \RqData\RequiredSettings\File\FileWithData;
use \RqData\Registry\FormStateKeeper;

class Homepage extends DisplayWithErrorMessages {

	protected function setUpWorker() {
		parent::setUpWorker();
		$this->setUpValuesToView();
		$this->setUpTemplatesToView();
	}

	protected function render() {
		$this->getFetcher()->display('index.tpl');
	}

	protected function setUpValuesToView() {
		$this->getFetcher()->assign('formStatesHistory', $this->getFormStateHolder());
		$this->getFetcher()->assign('operationList', $this->getOperationList());
		$this->getFetcher()->assign('consequence', $this->getConsequence());
		$this->getFetcher()->assign('measurementSettings', $this->getMeasurements());
		$this->getFetcher()->assign('inputFileName', FileWithData::FILE_NAME);
		$this->getFetcher()->assign(
			'measurementSettingsRegistry',
			array(
				'code' => MeasurementSettings::CODE,
				'name' => MeasurementSettings::HUMAN_NAME
			)
		);
	}

	protected function setUpTemplatesToView() {
		$this->getFetcher()->assign('css', array('main.css', 'opentip.css', 'homepage.css'));
		$this->getFetcher()->assign(
			'headerJs',
			array('libraries/jquery.js', 'libraries/jquery.formautofill.min.js', 'libraries/opentip-jquery.min.js')
		);
		$this->getFetcher()->assign(
			'footerJs',
			array('homepage.js', 'display_trigger.js')
		);
	}

	protected function getOperationList() {
		return new OperationList;
	}

	protected function getConsequence() {
		return new MaximalCtValueSettings;
	}

	protected function getMeasurements() {
		return new MeasurementSettings;
	}

	protected function getFormStateHolder() {
		return new FormStateKeeper();
	}
}