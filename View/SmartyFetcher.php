<?php
namespace RqData\View;

class SmartyFetcher extends \RqData\Core\Object implements Fetcher {
	private $smarty;
	private $template;

	public function __construct(\Smarty $smarty, $template) {
		$this->smarty = $smarty;
		$this->template = $template;
	}

	public function assign($name, $value) {
		$this->getFetcher()->assign($name, $value);
	}

	public function fetch() {
		return $this->getFetcher()->fetch($this->getTemplate());
	}

	/**
	 * @return \Smarty
	 */
	protected function getFetcher() {
		return $this->smarty;
	}

	protected function getTemplate() {
		return $this->template;
	}
}