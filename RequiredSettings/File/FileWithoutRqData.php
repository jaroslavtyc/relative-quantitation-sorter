<?php
namespace RqData\RequiredSettings\File;

class FileWithoutRqData extends WithData {
	const HUMAN_NAME = 'RQ data je nutné vypočítat';
	const CODE = 'fileWitoutRqData';
	const VALUE = '';

	public function __construct() {
		parent::__construct(self::SUBJECT_NAME + self::GENE_NAMES + self::CT_VALUES);
	}

	protected function initializeListOfExtendingSettings() {
		$this->setListOfExtendedSettings(array(
			 new \RqData\RequiredSettings\File\Calibrator,
			 new \RqData\RequiredSettings\File\ReferenceGenes,
		));
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