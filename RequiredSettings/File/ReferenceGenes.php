<?php
namespace RqData\RequiredSettings\File;

class ReferenceGenes extends ExtendingOptions {
	const CODE = 'referenceGenes';
	const HUMAN_NAME = 'referenční geny';
	const VALUE = '';

	public function __construct() {
		parent::__construct(new ReferenceGenesSeparator);
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