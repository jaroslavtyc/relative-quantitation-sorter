<?php
namespace RqData\Security;

class User {
	private $authenticator;
	private $login;
	private $password;

	public function __construct(Authenticator $authenticator, $login, $password) {
		$this->authenticator = $authenticator;
		$this->login = $login;
		$this->password = $password;
	}

	public function isLoggedIn() {
		return $this->authenticator->isAuthenticated($this->login, $this->password);
	}
}
