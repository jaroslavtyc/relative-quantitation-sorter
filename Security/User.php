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

	public function login($login, $password) {
		if (!$this->isLoggedIn()) {
			if ($this->authenticator->isAuthenticated($this->login, $this->password)) {
				$this->login = $login;
				$this->password = $password;
			} else {
				throw new \RqData\Security\Exceptions\IncorrectCredentials();
			}
		} else {
			throw new \RqData\Security\Exceptions\UserIsAlreadyLoggedIn();
		}
	}

	public function isLoggedIn() {
		return $this->authenticator->isAuthenticated($this->login, $this->password);
	}
}
