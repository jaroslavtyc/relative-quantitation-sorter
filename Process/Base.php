<?php
namespace RqData\Process;

use RqData\Registry\Errors;

abstract class Base {

	private $errors;

	public function __construct(Errors $errors){
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