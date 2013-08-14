<?php
namespace RqData\Frontend\Controllers;

class Login extends DisplayWithErrorMessages {
	private $user;

	public function __construct(\RqData\View\Fetcher $fetcher, \RqData\Security\User $user) {
		$this->user = $user;
		if (!$this->user->isLoggedIn() && isset($_POST['login'])) {
			$this->user->login($_POST['login'], $_POST['password']);
		}
		parent::__construct($fetcher);
	}

	public function display() {
		$this->getFetcher()->assign('css', array('Frontend/css/main.css','Frontend/css/login.css'));
		$this->getFetcher()->assign('headerJs', array('libraries/jquery.js'));
		$this->getFetcher()->assign('user', $this->user);
		parent::display();
	}
}
