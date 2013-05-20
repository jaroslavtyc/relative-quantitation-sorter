<?php
namespace RqData\RequiredSettings\File;

class FileWithoutRqData extends FileWithData {

	const HUMAN_NAME = 'RQ data je nutné vypočítat';
	const CODE = 'fileWitoutRqData';
	const VALUE = '';

	public function __construct() {
		parent::__construct(self::SUBJECT_NAME + self::GENE_NAMES + self::CT_VALUES);
	}

	protected function setListOfExtendingSettings() {
		$this->listOfExtendingSettings = array(
			 new \RqData\RequiredSettings\File\Calibrator,
			 new \RqData\RequiredSettings\File\ReferenceGenes,
		);
	}
}