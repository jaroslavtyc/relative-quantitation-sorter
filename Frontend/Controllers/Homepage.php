<?php
namespace RqData\Frontend\Controllers;

class Homepage extends DisplayWithErrorMessages {

	public function display() {
		$this->setUpValuesForFetch();
		$this->setUpWebpageTemplateForFetch();
		parent::display();
	}

	protected function setUpValuesForFetch() {
		$this->getFetcher()->assign('formStatesHistory', $this->getFormStateKeeper());
		$this->getFetcher()->assign('operationList', $this->getOperationList());
		$this->getFetcher()->assign('consequence', $this->getConsequenceOfCtMaximum());
		$this->getFetcher()->assign('measurementSettings', $this->getMeasurementSettings());
		$this->getFetcher()->assign('inputFileName', \RqData\RequiredSettings\File\WithData::FILE_NAME);
		$this->getFetcher()->assign(
			'measurementSettingsRegistry',
			array(
				'code' => \RqData\OptionalSettings\Registry\MeasurementSettings::CODE,
				'name' => \RqData\OptionalSettings\Registry\MeasurementSettings::HUMAN_NAME
			)
		);
	}

	protected function setUpWebpageTemplateForFetch() {
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
		return new \RqData\RequiredSettings\Options\OperationList;
	}

	protected function getConsequenceOfCtMaximum() {
		return new \RqData\OptionalSettings\Consequences\CtMaximum;
	}

	protected function getMeasurementSettings() {
		return new \RqData\OptionalSettings\Registry\MeasurementSettings;
	}

	protected function getFormStateKeeper() {
		return new \RqData\Registry\FormStateKeeper();
	}
}