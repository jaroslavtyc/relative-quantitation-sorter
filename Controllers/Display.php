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
	 * @return \universal\View\Smarty
	 */
	protected function getViewer() {
		if (!isset($this->viewer)) {
			$this->viewer = $this->buildViewer();
		}
		return $this->viewer;
	}

	/**
	 * @return \universal\View\Smarty
	 */
	protected function buildViewer() {
		$smarty = \universal\View\Smarty::get();
		$smarty->debugging = FALSE;
		$smarty->caching = FALSE;
		return $smarty;
	}
}