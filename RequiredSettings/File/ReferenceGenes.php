<?php
namespace RqData\RequiredSettings\File;

class ReferenceGenes extends ExtendingOptions {

	const CODE = 'referenceGenes';
	const HUMAN_NAME = 'referenční geny';
	const VALUE = '';

	public function __construct() {
		parent::__construct();
	}

	protected function setNote() {
		$this->note = new ReferenceGenesSeparator;
	}

}