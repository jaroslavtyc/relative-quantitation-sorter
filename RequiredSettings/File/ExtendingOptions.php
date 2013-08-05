<?php
namespace RqData\RequiredSettings\File;

abstract class ExtendingOptions extends \RqData\RequiredSettings\Settings {
	protected $note;

	public function __construct(\RqData\RequiredSettings\Settings $note) {
		$this->note = $note;
		parent::__construct();
	}

	public function getNote() {
		return $this->note;
	}
}