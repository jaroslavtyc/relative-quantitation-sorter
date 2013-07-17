<?php
namespace RqData\View;

class HistoryFetcher extends SmartyFetcher {

	public function __construct(\Smarty $smarty) {
		parent::__construct($smarty, 'history.tpl');
	}

	protected function setUpWorker() {}
}