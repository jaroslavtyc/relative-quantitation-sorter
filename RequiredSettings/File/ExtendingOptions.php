<?php
namespace RqData\RequiredSettings\File;

abstract class ExtendingOptions extends \RqData\RequiredSettings\Settings {

	protected $note;

	public function __construct() {
		$this->initializeNote();
		parent::__construct();
	}

	abstract protected function initializeNote();

	protected function setNote($value) {
		$this->note = $value;
	}

	public function getNote() {
		return $this->note;
	}
}