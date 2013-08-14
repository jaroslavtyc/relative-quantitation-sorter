<?php
namespace RqData\Security;

class Authenticator extends \RqData\Core\Object {
	private $loginPasswordPairs;

	public function __construct(\ArrayAccess $loginPasswordPairs) {
		$this->loginPasswordPairs = $loginPasswordPairs;
	}

	public function isAuthenticated($username, $password) {
		return $this->loginPasswordPairs->offsetExists($username) && $this->loginPasswordPairs->offsetGet($username) === $password;
	}
}
