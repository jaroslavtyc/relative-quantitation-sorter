<?php
namespace RqData\RequiredSettings\File;

class Calibrator extends ExtendingOptions {
	const CODE = 'calibrator';
	const HUMAN_NAME = 'kalibrátor';
	const VALUE = '';

	public function __construct() {
		parent::__construct(new CalibratorExplaining);
	}

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