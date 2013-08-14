<?php
namespace RqData\Frontend\Controllers;

use RqData\History\File;

class History extends DisplayWithErrorMessages {
	public function __construct(\RqData\View\Fetcher $fetcher, \RqData\Security\User $user) {
		if (!$user->isLoggedIn()) {
			throw new \RqData\Security\Exceptions\UnauthorizedAccess();
		} else {
			parent::__construct($fetcher);
		}
	}


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
