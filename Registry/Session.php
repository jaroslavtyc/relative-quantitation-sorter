<?php
namespace RqData\Registry;

class Session {

	private $container;

	public function __construct() {
		$this->ensureSession();
		$this->container = new \ArrayObject(& $_SESSION);
	}

	private function ensureSession() {
		if ($this->getId() === '') { // session does not exists yet
			if ($this->haveBeenHeadersSent()) { // any header was already sent, session can not be started
				throw new Exceptions\HeadersAlreadySentException();
			}

			$this->startSession();
			if ($this->getId() === '') { // session has not been started
				throw new Exceptions\StartingSessionException();
			}
		}
	}

	public function getId() {
		return \session_id();
	}

	private function haveBeenHeadersSent() {
		return \headers_sent();
	}

	private function startSession() {
		\session_start();
	}

	public function setValue($name, $value) {
		$this->getContainer()->offsetSet($name, $value);
	}

	public function getValue($name) {
		$this->getContainer()->offsetGet($name);
	}

	public function isValueSet($name) {
		return $this->getContainer()->offsetExists($name) && !\is_null($this->getContainer()->offsetGet($name));
	}

	public function unsetValue($name) {
		return $this->getContainer()->offsetUnset($name);
	}

	/**
	 * @return \ArrayObject
	 */
	private function getContainer() {
		return $this->container;
	}
}