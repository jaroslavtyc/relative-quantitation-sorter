<?php
namespace RqData\View;

use RqData\Core\Object;

abstract class SmartyViewer extends Object implements Viewer {

	private $fetcher;

	public function __construct(Fetcher $fetcher) {
		$this->fetcher = $fetcher;
	}

	public function display() {
		echo $this->getFetcher()->fetch();
	}

	/**
	 * @return Fetcher
	 */
	protected function getFetcher() {
		return $this->fetcher;
	}
}