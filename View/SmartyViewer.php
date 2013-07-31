<?php
namespace RqData\View;

abstract class SmartyViewer extends \RqData\Core\Object implements Viewer {
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