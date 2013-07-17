<?php
namespace RqData\Frontend\Controllers;

use RqData\History\File;

class History extends DisplayWithErrorMessages {

	protected function setUpWorker() {
		parent::setUpWorker();
		$this->getWorker()->assign('history', $this->buildHistoryFile());
		$this->getWorker()->assign('css', array('main.css','history.css','system/main.css'));
		$this->getWorker()->assign('headerJs', array('libraries/jquery.js'));
	}

	protected function buildHistoryFile() {
		return new File($this->getErrors());
	}

	protected function render() {
		$this->getWorker()->display('history.tpl');
	}
}