<?php
namespace RqData\Process;

use RqData\Registry\UserErrors;

class ResultFileDownloader extends Base {

	private $result;

	public function __construct(Result $result, UserErrors $errors){
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
			$this->getResult()->getUserFileBasename()
		);
	}

	/**
	 * @return Result
	 */
	protected function getResult() {
		return $this->result;
	}
}