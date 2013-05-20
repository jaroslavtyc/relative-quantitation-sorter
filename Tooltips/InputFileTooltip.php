<?php
namespace RqData\Tooltips;

use \RqData\RequiredSettings\Options\ColumnsPurpose;

class InputFileTooltip implements Tooltip {

	public function getMessage() {
		$smarty = \TycSmarty::get(FALSE);
		$smarty->assign('columnsPurpose', $this->getColumnsPurpose());
		return $smarty->fetch('inputFileTooltip.tpl');
	}

	protected function getColumnsPurpose() {
		return new ColumnsPurpose(ColumnsPurpose::ALL);
	}
}