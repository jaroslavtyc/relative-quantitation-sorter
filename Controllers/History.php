<?php
namespace RqData\Controllers;

use RqData\History\File;

class History extends DisplayWithErrorMessages {

	protected function setUpView() {
		$this->setUpValuesToView();
	}

	protected function setUpValuesToView() {
		parent::setUpValuesToView();
		$this->getViewer()->assign('history', $this->getHistoryFile());
		$this->getViewer()->assign('css', array('main.css','history.css','system/main.css'));
		$this->getViewer()->assign('headerJs', array('libraries/jquery.js'));
	}

	protected function getHistoryFile() {
		return new File();
	}

	protected function render() {
		$this->getViewer()->display('history.tpl');
	}
}