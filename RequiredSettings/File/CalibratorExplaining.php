<?php
namespace RqData\RequiredSettings\File;

class CalibratorExplaining extends \RqData\RequiredSettings\Settings {
	const HUMAN_NAME = 'název subjektu';
	const VALUE = '';
	const CODE = 'calibratorExplaining';
	
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