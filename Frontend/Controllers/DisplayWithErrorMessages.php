<?php
namespace RqData\Frontend\Controllers;

use RqData\View\SmartyViewer;
use RqData\Registry\UserErrors;

abstract class DisplayWithErrorMessages extends SmartyViewer {

	const ERROR_ANCHOR_NAME = 'process-error-report';

	private $errors;

	public function display() {
		$this->setUpFetcher();
		parent::display();
		$this->getErrors()->forgotErrors();
	}

	/**
	 * @return UserErrors
	 */
	protected function getErrors() {
		if (!isset($this->errors)) {
			$this->errors = new UserErrors();
		}
		return $this->errors;
	}

	protected function setUpFetcher() {
		$this->getFetcher()->assign('errors', $this->getErrorMessages());
		$this->getFetcher()->assign('errorsCount', $this->getCountOfErrors());
		$this->getFetcher()->assign('errorsAnchorName', self::ERROR_ANCHOR_NAME);
	}

	protected function getErrorMessages() {
		if ($this->getErrors()->existsOldError()) {
			return $this->getErrors()->getErrors(UserErrors::DEFAULT_RETURN_METHOD);
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