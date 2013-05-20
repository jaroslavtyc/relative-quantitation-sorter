<?php
namespace RqData\Registry;

class FormStateKeeper extends \UniversalClass {

	public function __construct() {
		\Session::ensure();
	}

	public function holdFormStates(array $formStates) {
		if (!isset($_SESSION[$this->getSessionIndex()])) {
			$_SESSION[$this->getSessionIndex()] = array();
		}
		$_SESSION[$this->getSessionIndex()] = array_merge(
			$_SESSION[ $this->getSessionIndex() ],
			$formStates
		);
	}

	public function getHeldFormStates() {
		if (!isset($_SESSION[$this->getSessionIndex()])) {
			return array();
		} else {
			return $_SESSION[$this->getSessionIndex()];
		}
	}

	public function resolveValue($itemName, $defaultValue = '') {
		if (!array_key_exists($itemName, $this->getHeldFormStates())) {
			return $defaultValue;
		}
		$heldFormStates = $this->getHeldFormStates();
		return $heldFormStates[$itemName];
	}

	public function resolveArrayValue($arrayName, $itemName, $defaultValue = '') {
		$valueToReturn = $defaultValue;
		if (array_key_exists($arrayName, $this->getHeldFormStates())) {
			$heldFormStates = $this->getHeldFormStates();
			if (array_key_exists($itemName, $heldFormStates[$arrayName])) {
				$valueToReturn = $heldFormStates[$arrayName][$itemName];
			}
		}
		return $valueToReturn;
	}

	protected function getSessionIndex() {
		return get_class($this);
	}
}