<?php
namespace RqData\RequiredSettings\File;

abstract class ExtendingOptions extends \SingleHtmlOptionModel {

	protected $note;

	public function __construct() {
		$this->setNote();
		$this->makePropertyReadable('note');
		parent::__construct();
	}

	protected function setNote() {
		$this->note = FALSE;
	}
}