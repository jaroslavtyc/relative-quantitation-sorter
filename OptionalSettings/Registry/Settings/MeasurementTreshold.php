<?php
namespace RqData\OptionalSettings\Registry\Settings;

class MeasurementTreshold implements \RqData\Html\SingleOption {
	const CODE = 'measurementTreshold';
	const HUMAN_NAME = 'treshold';
	const VALUE = FALSE;

	public function getCode() {
		return self::CODE;
	}

	public function getHumanName() {
		return self::HUMAN_NAME;
	}

	public function getValue() {
		return self::VALUE;
	}
}