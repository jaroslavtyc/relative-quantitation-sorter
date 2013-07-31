<?php
namespace RqData\Registry;

class FormStateKeeper extends RqData\Core\Object {
	private $session;

	public function __construct() {
		$this->session = new Session();
	}

	public function holdFormStates(array $formStates) {
		if (!$this->getSession()->isValueSet($this->getSessionIndex())) {
			$this->getSession()->setValue($this->getSessionIndex(), $formStates);
		} else {
			$this->getSession()->setValue(
				$this->getSessionIndex(),
				array_merge($this->getSession()->getValue($this->getSessionIndex()), $formStates)
			);
		}
	}

	/**
	 * @return Session
	 */
	private function getSession() {
		return $this->session;
	}

	public function getHeldFormStates() {
		if (!$this->getSession()->isValueSet($this->getSessionIndex())) {
			return array();
		} else {
			return $this->getSession()->getValue($this->getSessionIndex());
		}
	}

	public function resolveValue($itemName, $defaultValue = '') {
		if (!array_key_exists($itemName, $this->getHeldFormStates())) {
			$value = $defaultValue;
		} else {
			$heldFormStates = $this->getHeldFormStates();
			$value = $heldFormStates[$itemName];
		}

		return $value;
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