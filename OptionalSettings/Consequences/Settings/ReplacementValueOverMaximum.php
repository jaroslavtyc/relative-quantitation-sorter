<?php
namespace RqData\OptionalSettings\Consequences\Settings;

class ReplacementValueOverMaximum implements \RqData\Html\SingleOption {
	private $humanName;
	private $code;
	private $value;

	public function __construct() {
		$this->humanName = 'hodnota RQ <strong>rovna a nad</strong> zlomovou hodnotou';
		$this->code = 'replacementValueOverMaximum';
		$this->value = '';
	}

	public function getHumanName() {
		return $this->humanName;
	}

	public function getCode() {
		return $this->code;
	}

	public function getValue() {
		return $this->value;
	}

}