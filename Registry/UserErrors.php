<?php
namespace RqData\Registry;

use Exceptions\UnkownReturnMethodCodeException;

class UserErrors {

	const GET_RETURN_METHOD = 1;
	const SESSION_RETURN_METHOD = 10;
	const SQL_RETURN_METHOD = 100;
	const DEFAULT_RETURN_METHOD = self::SESSION_RETURN_METHOD;
	const PREFIX_FOR_GET_RETURN_METHOD = 'errors_';
	const MESSAGES_DELIMITER_FOR_GET_RETURN_METHOD = '#';
	const MAXIMUM_RETURNED_ERRORS = -1;

	private $newErrors = array();
	private $oldErrors = array();
	private $returnMethod;
	private $projectName;
	private $session;

	public function __construct($returnMethod = self::DEFAULT_RETURN_METHOD) {
		$this->initializeNewErrors();
		$this->initializeOldErrors();
		$this->returnMethod = $returnMethod;
		$this->projectName = get_class($this);
		$this->setOldErrors();
	}

	private function initializeOldErrors() {
		$this->oldErrors = new \ArrayObject;
	}

	private function initializeNewErrors() {
		$this->newErrors = new \ArrayObject;
	}

	protected function getReturnMethodName($code) {
		$returnMethod = FALSE;
		$code = $this->validateReturnMethod($code);
		switch($code){
			case self::GET_RETURN_METHOD :
				$returnMethod = 'GET';
				break;
			case self::SESSION_RETURN_METHOD :
				$returnMethod = 'SESSION';
				break;
			case self::SQL_RETURN_METHOD :
				$returnMethod = 'SQL';
				break;
			default:
				throw new UnkownReturnMethodCodeException($code);
		}

		return $returnMethod;
	}

	protected function validateReturnMethod($code) {
		$code = (int) $code;
		switch($code) {
			case self::GET_RETURN_METHOD:
				break;
			case self::SESSION_RETURN_METHOD:
				break;
			case self::SQL_RETURN_METHOD:
				break;
			case self::ANY_RETURN_METHOD:
				break;
			default:
				throw new UnkownReturnMethodCodeException($code);
		}

		return $code;
	}

	public function rememberError($message, $groupName = FALSE) {
		$returnMethod = $this->returnMethod;
		if($groupName !== FALSE)  {
			$groupName = (string) $groupName;
			if(!isset($this->newErrors[$returnMethod][$groupName])){
				$this->newErrors[$returnMethod][$groupName] = array();
			}
			$this->newErrors[$returnMethod][$groupName][] = $message;
		}else{
			$this->newErrors[$returnMethod][] = $message;
		}
	}

	public function redirectWithErrorsTransfer($domainAbsoluteUrl = 'index.php') {
		$url = 'Location: ' . $this->getBaseUrl() . $domainAbsoluteUrl;
		if (isset($this->newErrors[ $this->getReturnMethodName(self::GET_RETURN_METHOD) ])) {
			$counter = 1;
			$numberedErrors = array();
			foreach($this->newErrors[ $this->getReturnMethodName(self::GET_RETURN_METHOD) ] as $index => $errorOrGroup){
				if(is_string($index) and is_array($errorOrGroup)){
					$concatenatedErrors = $index;
					foreach($errorOrGroup as $message) {
						$concatenatedErrors .= dechex(ord(self::MESSAGES_DELIMITER_FOR_GET_RETURN_METHOD)) . (string) $message;
					}
					$numberedErrors[ self::PREFIX_FOR_GET_RETURN_METHOD . $counter ] = $concatenatedErrors;
				}
				$counter++;
			}

			$this->newErrors[ $this->getReturnMethodName(self::GET_RETURN_METHOD) ] = $numberedErrors;
			$get = $this->arrayToUrlGet($this->newErrors[ $this->getReturnMethodName(self::GET_RETURN_METHOD) ]);
			$url .= '?' . $get;
			unset($this->newErrors[ $this->getReturnMethodName(self::GET_RETURN_METHOD) ]);
		}

		if (isset($this->newErrors[ $this->getReturnMethodName(self::SESSION_RETURN_METHOD) ])) {
			$this->getSession()->setValue($this->projectName, $this->newErrors[ $this->getReturnMethodName(self::SESSION_RETURN_METHOD) ]);
		}

		$this->redirect($url);
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

	private function arrayToUrlGet(\Traversable $values) {
		$and = FALSE;
		$query = '';
		foreach($values as $index => $value){
			$index = htmlspecialchars($index);
			$value = htmlspecialchars((string) $value);
			$query .= ($and ? '&': '') . $index . '=' . $value;
			$and = TRUE;
		}

		return $query;
	}

	private function redirect($url) {
		header($url);
		exit;
	}

	public function existsError($returnMethod = self::ANY_RETURN_METHOD) {
		return $this->existsOldError($returnMethod) && $this->existsNewError($returnMethod);
	}

	public function existsOldError($returnMethod = self::ANY_RETURN_METHOD) {
		return $this->calculateNumberOfErrors($this->oldErrors, $returnMethod, 1) > 0;
	}

	public function existsNewError($returnMethod = self::ANY_RETURN_METHOD) {
		return $this->calculateNumberOfErrors($this->newErrors, $returnMethod, 1) > 0;
	}

	public function getAmountOfNewErrors($returnMethod = self::ANY_RETURN_METHOD, $atMost = self::MAXIMUM_RETURNED_ERRORS) {
		return $this->calculateNumberOfErrors($this->newErrors, $returnMethod, $atMost);
	}

	public function getAmountOfErrors() {
		$oldErrorsCount = $this->calculateNumberOfErrors($this->oldErrors, self::ANY_RETURN_METHOD, self::MAXIMUM_RETURNED_ERRORS, TRUE);
		$newErrorsCount = $this->calculateNumberOfErrors($this->newErrors, self::ANY_RETURN_METHOD, self::MAXIMUM_RETURNED_ERRORS, TRUE);

		return $oldErrorsCount + $newErrorsCount;
	}

	private function calculateNumberOfErrors($errors, $returnMethod = self::ANY_RETURN_METHOD, $atMost = self::MAXIMUM_RETURNED_ERRORS) {
		$returnMethod = $this->validateReturnMethod($returnMethod);
		$atMost = (int) $atMost;
		$amount = 0;
		if ($returnMethod !== self::ANY_RETURN_METHOD) {
			$searchedReturnMethod = $this->getReturnMethodName($returnMethod);
		}

		foreach ($errors as $currentReturnMethod=>$singleMethodErrors) {
			if (($returnMethod === self::ANY_RETURN_METHOD) or ($searchedReturnMethod == $currentReturnMethod)) {
				foreach($singleMethodErrors as $index => $errorOrGroup) {
					if (is_string($index) && is_array($errorOrGroup)) {
						$amount += count($errorOrGroup);
					} else {
						$amount++;
					}

					if (($atMost > 0) and ($amount == $atMost)) {
						break 2;
					}
				}
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

	protected function setOldErrors($returnMethod = self::ANY_RETURN_METHOD) {
		$returnMethod = $this->validateReturnMethod($returnMethod);
		$workingMethodCode = (string) $returnMethod;
		for($i = 0; $i < strlen($workingMethodCode); $i++) {
			$workingMethodCode = $this->validateReturnMethod($workingMethodCode[$i] . str_repeat('0', $i));
			$workingMethodCode = $this->validateReturnMethod($workingMethodCode);
			$workingMethodName = $this->getReturnMethodName($workingMethodCode);
			switch ($workingMethodCode) {
				case self::GET_RETURN_METHOD:
					if (!isset($this->oldErrors[$workingMethodName])) {
						$this->oldErrors[$workingMethodName] = array();
					}

					if (isset($_GET)) {
						foreach($_GET as $group => $possibleErrors) {
							if (strpos($group, self::PREFIX_FOR_GET_RETURN_METHOD) === 0) {
								$possibleErrors = explode(self::MESSAGES_DELIMITER_FOR_GET_RETURN_METHOD, $possibleErrors);
								$group = $possibleErrors[0];
								unset($possibleErrors[0]);
								$this->oldErrors[$workingMethodName][$group] = $possibleErrors;
							}
						}
					}

					break;
				case self::SESSION_RETURN_METHOD:
					$session = $this->getSession();
					if ($session->isValueSet($this->projectName)) {
						$this->oldErrors[$workingMethodName] = $session->getValue($this->projectName);
					}else{
						$this->oldErrors[$workingMethodName] = array();
					}

					break;
				case self::SQL_RETURN_METHOD:
					$this->oldErrors[$workingMethodName] = array();
					break;
				default:
					throw new UnkownReturnMethodCodeException($workingMethodCode);
			}
		}
	}

	public function getErrors($returnMethod = self::ANY_RETURN_METHOD) {
		$returnMethod = $this->validateReturnMethod($returnMethod);
		$errors = array();
		if($returnMethod !== self::ANY_RETURN_METHOD){
			$methodName = $this->getReturnMethodName($returnMethod);
			if (isset($this->oldErrors[$methodName])) {
				$errors = $this->oldErrors[$methodName];
			}
		}else{
			$errors = $this->oldErrors;
		}

		return $errors;
	}
}