<?php
namespace RqData\Core;

class Iterable extends Object implements \Iterator {
	protected $data;
	protected $currentKey;

	public function __construct(array $data) {
		$this->setData($data);
		$this->rewind();
	}

	private function setData(array $data) {
		$this->data = $data;
	}

	public function getData() {
		return $this->data;
	}

	public function rewind() {
		reset($this->data);
		$this->currentKey = $this->key();
	}

	public function current() {
		return current($this->data);
	}

	public function key() {
		// returns NULL if out of array
		return key($this->data);
	}

	public function next() {
		next($this->data);
		// if out of array, sets NULL
		$this->currentKey = $this->key();
	}

	public function valid() {
		return !is_null($this->currentKey);
	}

	public function isLast() {
		next($this->data);
		$isLast = (NULL === key($this->data));
		prev($this->data);

		return $isLast;
	}

	public function getSize() {
		return count($this->data);
	}
}