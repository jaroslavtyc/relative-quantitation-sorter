<?php
namespace RqData\Tooltips;
use RqData\View\SmartyFetcher;

class Tooltips {

	/**
	 * @param string $name
	 * @return Tooltip
	 */
	public function getTooltip($name) {
		return $this->createTooltip($name);
	}

	/**
	 * @param string $name
	 * @return Tooltip
	 */
	public function displayTooltip($name) {
		echo $this->getTooltip($name)->getMessage();
	}

	/**
	 * @param string $name
	 * @return Tooltip
	 */
	protected function createTooltip($name) {
		switch ($name) {
			case 'inputFileFormat' :
				return new InputFileTooltip(new SmartyFetcher(new \Smarty, 'inputFileTooltip.tpl'));
			default:
				throw new UnkownTooltipNameException($name);
		}
	}
}

class UnkownTooltipNameException extends \InvalidArgumentException {}