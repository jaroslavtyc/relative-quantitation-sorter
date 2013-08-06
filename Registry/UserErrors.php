<?php
namespace RqData\Registry;

class UserErrors {
	const MAXIMUM_RETURNED_ERRORS = -1;

	private $newErrors = array();
	private $oldErrors = array();
	private $projectName;
	private $session;

	public function __construct() {
		$this->initializeNewErrors();
		$this->initializeOldErrors();
		$this->projectName = get_class($this);
		$this->setOldErrors();
	}

	private function initializeOldErrors() {
		$this->oldErrors = new \ArrayObject;
	}

	private function initializeNewErrors() {
		$this->newErrors = new \ArrayObject;
	}

	public function rememberError($message, $groupName = FALSE) {
		if($groupName !== FALSE)  {
			$groupName = (string) $groupName;
			if(!isset($this->newErrors[$groupName])){
				$this->newErrors[$groupName] = array();
			}
			$this->newErrors[$groupName][] = $message;
		}else{
			$this->newErrors[] = $message;
		}
	}

	public function redirectWithErrorsTransfer($domainAbsoluteUrl = 'index.php') {
		if (count($this->newErrors) > 0) {
			$this->getSession()->setValue($this->projectName, $this->newErrors);
		}

		$this->redirect($this->getBaseUrl() . $domainAbsoluteUrl);
	}

	private function getBaseUrl() {
		if (!isset($_SERVER['HTTP_HOST'])) {
			throw new Exceptions\UnkownHttpHostException();
		}

		if (!isset($_SERVER['SERVER_PROTOCOL'])) {
			throw new UnkownServerProtocolException();
		}

		$url = strtolower(strstr($_SERVER['SERVER_PROTOCOL'],'/',TRUE)) . '://';
		$url .= $_SERVER['HTTP_HOST'];
		$url .= '/';

		return $url;
	}

	private function redirect($url) {
		header('Location: ' . $url);
		exit;
	}

	public function existsError() {
		return $this->existsOldError() && $this->existsNewError();
	}

	public function existsOldError() {
		return $this->calculateNumberOfErrors($this->oldErrors, 1) > 0;
	}

	public function existsNewError() {
		return $this->calculateNumberOfErrors($this->newErrors, 1) > 0;
	}

	public function getAmountOfNewErrors($atMost = self::MAXIMUM_RETURNED_ERRORS) {
		return $this->calculateNumberOfErrors($this->newErrors, $atMost);
	}

	public function getAmountOfErrors() {
		$oldErrorsCount = $this->calculateNumberOfErrors($this->oldErrors, self::MAXIMUM_RETURNED_ERRORS, TRUE);
		$newErrorsCount = $this->calculateNumberOfErrors($this->newErrors, self::MAXIMUM_RETURNED_ERRORS, TRUE);

		return $oldErrorsCount + $newErrorsCount;
	}

	private function calculateNumberOfErrors($errors, $atMost = self::MAXIMUM_RETURNED_ERRORS) {
		$atMost = (int) $atMost;
		$amount = 0;

		foreach($errors as $index => $errorOrGroup) {
			if (is_string($index) && is_array($errorOrGroup)) {
				$amount += count($errorOrGroup);
			} else {
				$amount++;
			}

			if (($atMost > 0) and ($amount === $atMost)) {
				break;
			}
		}

		return $amount;
	}

	public function forgotErrors() {
		if($this->getSession()->isValueSet($this->projectName)) {
			$this->getSession()->unsetValue($this->projectName);
		}

		$this->initializeNewErrors();
	}

	/**
	 * @return Session
	 */
	private function getSession() {
		if (!isset($this->session)) {
			$this->session = new Session();
		}

		return $this->session;
	}

	protected function setOldErrors() {
		if ($this->getSession()->isValueSet($this->projectName)) {
			$this->oldErrors = $this->getSession()->getValue($this->projectName);
		}else{
			$this->oldErrors = array();
		}
	}

	public function getErrors() {
		return $this->oldErrors;
	}
}