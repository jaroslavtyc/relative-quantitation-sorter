<?php
namespace RqData\Frontend\Controllers;

use RqData\History\File;

class History extends DisplayWithErrorMessages {
	public function display() {
		$this->getFetcher()->assign('history', $this->buildHistoryFile());
		$this->getFetcher()->assign('css', array('main.css','history.css','system/main.css'));
		$this->getFetcher()->assign('headerJs', array('libraries/jquery.js'));
		parent::display();
	}

	protected function buildHistoryFile() {
		return new File($this->getErrors());
	}
}
