<?php
namespace RqData\RequiredSettings\File;

class Calibrator extends ExtendingOptions {

	const CODE = 'calibrator';
	const HUMAN_NAME = 'kalibrátor';
	const VALUE = '';

	public function __construct() {
		parent::__construct();
	}

	protected function setNote() {
		$this->note = new CalibratorExplaining;
	}

}