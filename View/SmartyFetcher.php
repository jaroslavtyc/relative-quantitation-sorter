<?php
namespace RqData\View;

use RqData\Core\Object;

abstract class SmartyFetcher extends Object implements Fetcher {

	private $smarty;
	private $template;

	public function __construct(\Smarty $smarty, $template) {
		$this->smarty = $smarty;
		$this->template = $template;
	}

	public function assign($name, $value) {
		$this->getWorker()->assign($name, $value);
	}

	public function fetch() {
		$this->setUpWorker();

		return $this->render();
	}

	abstract protected function setUpWorker();

	protected function render() {
		return $this->getWorker()->fetch($this->getTemplate());
	}

	/**
	 * @return \Smarty
	 */
	protected function getWorker() {
		return $this->smarty;
	}

	protected function getTemplate() {
		return $this->template;
	}
}