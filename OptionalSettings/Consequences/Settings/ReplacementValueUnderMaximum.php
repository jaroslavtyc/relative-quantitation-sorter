<?php
namespace RqData\OptionalSettings\Consequences\Settings;

class ReplacementValueUnderMaximum implements \RqData\Html\SingleOption {
	private $humanName;
	private $code;
	private $value;

	public function __construct() {
		$this->humanName = 'hodnota RQ <strong>pod</strong> zlomovou hodnotou';
		$this->code = 'replacementValueUnderMaximum';
		$this->value = 0.0001;
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