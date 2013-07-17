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
		$this->getFetcher();
		$smarty = \universal\View\Smarty::get(FALSE);
		$smarty->assign('columnsPurpose', $this->getColumnsPurpose());
		return $smarty->fetch('inputFileTooltip.tpl');
	}

	protected function getFetcher() {
		
	}

	protected function getColumnsPurpose() {
		return new ColumnsPurpose(ColumnsPurpose::ALL);
	}
}