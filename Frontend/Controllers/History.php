<?php
namespace RqData\Frontend\Controllers;

use RqData\History\File;

class History extends DisplayWithErrorMessages {

	protected function setUpFetcher() {
		parent::setUpFetcher();
		$this->getFetcher()->assign('history', $this->buildHistoryFile());
		$this->getFetcher()->assign('css', array('main.css','history.css','system/main.css'));
		$this->getFetcher()->assign('headerJs', array('libraries/jquery.js'));
	}

	protected function buildHistoryFile() {
		return new File($this->getErrors());
	}
}