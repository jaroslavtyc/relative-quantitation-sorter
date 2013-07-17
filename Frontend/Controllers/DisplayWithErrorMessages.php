<?php
namespace RqData\Frontend\Controllers;

use RqData\View\SmartyViewer;
use RqData\Registry\Errors;

abstract class DisplayWithErrorMessages extends SmartyViewer {

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
			$this->errors = new Errors();
		}
		return $this->errors;
	}

	protected function setUpWorker() {
		$this->getWorker()->assign('errors', $this->getErrorMessages());
		$this->getWorker()->assign('errorsCount', $this->getCountOfErrors());
		$this->getWorker()->assign('errorsAnchorName', self::ERROR_ANCHOR_NAME);
	}

	protected function getErrorMessages() {
		if ($this->getErrors()->existsOldError()) {
			return $this->getErrors()->getErrors(Errors::DEFAULT_RETURN_METHOD);
		} else {
			return array();
		}
	}

	protected function getCountOfErrors() {
		if ($this->getErrors()->existsOldError()) {
			return $this->getErrors()->getAmountOfErrors();
		} else {
			return 0;
		}
	}
}