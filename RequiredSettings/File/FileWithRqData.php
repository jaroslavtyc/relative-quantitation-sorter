<?php
namespace RqData\RequiredSettings\File;

class FileWithRqData extends WithData {
	const HUMAN_NAME = 'Soubor obsahuje RQ data';
	const CODE = 'fileWithData';
	const VALUE = '';

	public function __construct() {
		parent::__construct(self::SUBJECT_NAME | self::GENE_NAMES | self::CT_VALUES | self::RQ_VALUES);
	}

	protected function initializeListOfExtendingSettings() {
		$this->setListOfExtendedSettings(array());
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