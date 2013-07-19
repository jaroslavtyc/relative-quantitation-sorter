<?php
namespace RqData\Process;

use RqData\Registry\UserErrors;

abstract class Base {

	private $errors;

	public function __construct(UserErrors $errors){
		$this->errors = $errors;
	}

	abstract public function process();

	/**
	 * @return \RqData\Errors
	 */
	protected function getErrors() {
		return $this->errors;
	}
}