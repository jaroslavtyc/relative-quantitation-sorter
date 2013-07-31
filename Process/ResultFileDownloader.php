<?php
namespace RqData\Process;

use RqData\Registry\UserErrors;

class ResultFileDownloader extends Base {

	const SIZE_UNIT_KB = 1024; //2e10
	const CONTENT_TYPE_PLAINT_TEXT = 'plain/text';
	const CONTENT_TYPE_TEXT_JAVASCRIPT = 'type="text/javascript"';
	const CONTENT_TYPE_EXCEL = 'application/vnd.ms-excel';
	const DEFAULT_CONTENT_TYPE = self::CONTENT_TYPE_PLAINT_TEXT;

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
		$resource = fopen($this->getResult()->getFilename(), 'r');
		$this->sendFileDownloadHeader($this->getResult()->getUserFileBasename());
		while (!feof($resource)) {
			echo fgets($resource, self::SIZE_UNIT_KB);
		}
	}

	private function sendFileDownloadHeader($downloadedFilename, $originalFilepath) {
		$suffix = array();
		preg_match('~\.[^.]+$', $downloadedFilename, $suffix);
		if (empty($suffix[0])) {
			$contentType = self::DEFAULT_CONTENT_TYPE;
		} else {
			switch($suffix[0]) {
				case 'xls':
					$contentType = self::CONTENT_TYPE_EXCEL;
					break;
				case 'txt':
					$contentType = self::CONTENT_TYPE_PLAINT_TEXT;
					break;
				default:
					$contentType = self::DEFAULT_CONTENT_TYPE;
			}
		}

		header('Content-Type: ' . $contentType);
		header('Content-Disposition: attachment;filename="' . urlencode($downloadedFilename) . '"');
		header('Content-Length: ' . filesize($originalFilepath));
	}

	/**
	 * @return Result
	 */
	protected function getResult() {
		return $this->result;
	}
}