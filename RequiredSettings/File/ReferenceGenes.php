<?php
namespace RqData\RequiredSettings\File;

class ReferenceGenes extends ExtendingOptions {
	const CODE = 'referenceGenes';
	const HUMAN_NAME = 'referenční geny';
	const VALUE = '';

	protected function initializeNote() {
		$this->setNote(new ReferenceGenesSeparator);
	}
}