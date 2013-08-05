<?php
namespace RqData\RequiredSettings\File;

class ReferenceGenesSeparator extends \RqData\RequiredSettings\Settings {
	const HUMAN_NAME = 'oddělovač';
	const VALUE = ',';
	const CODE = 'referenceGenesNote';

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