<?php
namespace RqData\RequiredSettings\File;

class FileWithRqData extends FileWithData {

	const HUMAN_NAME = 'Soubor obsahuje RQ údaje';
	const CODE = 'fileWithData';
	const VALUE = '';

	public function __construct() {
		parent::__construct(self::SUBJECT_NAME | self::GENE_NAMES | self::CT_VALUES | self::RQ_VALUES);
	}
}