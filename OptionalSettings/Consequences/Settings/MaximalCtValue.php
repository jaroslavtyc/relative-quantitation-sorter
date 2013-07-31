<?php
namespace RqData\OptionalSettings\Consequences\Settings;

class MaximalCtValue implements \RqData\Html\SingleOption {
	private $humanName;
	private $code;
	private $value;

	public function __construct() {
		$this->humanName = 'maximální hodnota CT';
		$this->code = 'maximalCtValue';
		$this->value = 40;
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