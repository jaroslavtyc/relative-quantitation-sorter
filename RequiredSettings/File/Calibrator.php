<?php
namespace RqData\RequiredSettings\File;

class Calibrator extends ExtendingOptions {
	const CODE = 'calibrator';
	const HUMAN_NAME = 'kalibrátor';
	const VALUE = '';

	protected function initializeNote() {
		$this->setNote(new CalibratorExplaining);
	}
}