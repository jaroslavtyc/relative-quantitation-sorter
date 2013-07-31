<?php
namespace RqData\OptionalSettings\Registry\Settings;

class MeasurementBaseline implements \RqData\Html\SingleOption {
	const CODE = 'measurementBaseline';
	const HUMAN_NAME = 'baseline';
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