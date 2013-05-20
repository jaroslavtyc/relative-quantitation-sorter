<?php
namespace RqData\Controllers;

abstract class Display {

	private $viewer;

	public function display() {
		$this->setUpView();
		$this->render();
	}

	abstract protected function setUpView();

	abstract protected function render();

	/**
	 * @return \TycSmarty
	 */
	protected function getViewer() {
		if (!isset($this->viewer)) {
			$this->viewer = $this->buildViewer();
		}
		return $this->viewer;
	}

	/**
	 * @return \TycSmarty
	 */
	protected function buildViewer() {
		$smarty = \TycSmarty::get();
		$smarty->debugging = FALSE;
		$smarty->caching = FALSE;
		return $smarty;
	}
}