<?php
namespace RqData\Tooltips;

use RqData\RequiredSettings\Options\ColumnsPurpose;
use RqData\View\Fetcher;

class InputFileTooltip implements Tooltip {
	private $fetcher;

	public function __construct(Fetcher $fetcher) {
		$this->fetcher = $fetcher;
	}

	public function getMessage() {
		$this->getFetcher()->assign('columnsPurpose', $this->getColumnsPurpose());

		return $this->getFetcher()->fetch();
	}

	/**
	 * @return Fetcher
	 */
	protected function getFetcher() {
		return $this->fetcher;
	}

	protected function getColumnsPurpose() {
		return new ColumnsPurpose(ColumnsPurpose::ALL);
	}
}