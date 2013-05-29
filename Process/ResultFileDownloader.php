<?php
namespace RqData\Process;

use RqData\Registry\Errors;

class ResultFileDownloader extends Base {

	private $result;

	public function __construct(Result $result, Errors $errors){
		parent::__construct($errors);
		$this->result = $result;
	}

	public function process(){
		$this->getResult()->process();
		$this->offerFileDownload();
	}

	protected function offerFileDownload() {
		\universal\Folder\Utilities\HtmlUtilities::download(
			$this->getResult()->getFilename(),
			basename($this->getResult()->getFilename())
		);
	}

	/**
	 * @return Result
	 */
	protected function getResult() {
		return $this->result;
	}
}