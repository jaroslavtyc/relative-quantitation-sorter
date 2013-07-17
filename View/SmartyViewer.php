<?php
namespace RqData\View;

use RqData\Core\Object;

abstract class SmartyViewer extends Object implements Viewer {

	private $fetcher;

	public function __construct(Fetcher $fetcher) {
		$this->fetcher = $fetcher;
	}

	public function display() {
		$this->setUpWorker();
		$this->render();
	}

	abstract protected function setUpWorker();

	protected function render() {
		echo $this->getWorker()->fetch();
	}

	/**
	 * @return Fetcher
	 */
	protected function getWorker() {
		return $this->fetcher;
	}
}