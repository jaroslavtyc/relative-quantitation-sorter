<?php
namespace RqData\Controllers;

use RqData\Registry\Errors;

abstract class DisplayWithErrorMessages extends Display {

	const ERROR_ANCHOR_NAME = 'process-error-report';

	private $errors;

	public function display() {
		parent::display();
		$this->getErrors()->forgotErrors();
	}

	/**
	 * @return Errors
	 */
	protected function getErrors() {
		if (!isset($this->errors)) {
			$this->errors = Errors::get();
		}
		return $this->errors;
	}

	protected function setUpValuesToView() {
		$this->getViewer()->assign('errors', $this->getErrorMessages());
		$this->getViewer()->assign('errorsCount', $this->getCountOfErrors());
		$this->getViewer()->assign('errorsAnchorName', self::ERROR_ANCHOR_NAME);
	}

	protected function getErrorMessages() {
		if ($this->getErrors()->existOldError()) {
			return $this->getErrors()->getErrors(Errors::METODA_NAVRATU);
		} else {
			return array();
		}
	}

	protected function getCountOfErrors() {
		if ($this->getErrors()->existOldError()) {
			return $this->getErrors()->dejPocetChyb();
		} else {
			return 0;
		}
	}
}