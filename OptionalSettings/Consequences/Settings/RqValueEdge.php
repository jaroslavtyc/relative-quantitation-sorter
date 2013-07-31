<?php
namespace RqData\OptionalSettings\Consequences\Settings;

class RqValueEdge implements \RqData\Html\SingleOption {
	private $humanName;
	private $code;
	private $value;

	public function __construct() {
		$this->humanName = 'zlomová hodnota RQ';
		$this->code = 'rqValueEdge';
		$this->value = 0.05;
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