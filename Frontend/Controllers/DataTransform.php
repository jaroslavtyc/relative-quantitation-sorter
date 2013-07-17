<?php
namespace RqData\Frontend\Controllers;

use \RqData\Process\ResultFileDownloader;
use \RqData\Registry\Errors;
use RqData\Debugging\UserException;

class DataTransform {

	private $resultFileDownload;

	public function __construct(
		ResultFileDownloader $resultFileDownload,
		Errors $errors
	) {
		$this->resultFileDownload = $resultFileDownload;
		$this->errors = $errors;
	}

	public function run() {
		try {
			$this->getResultFileDownload()->process();
		} catch (UserException $exception) {
			$this->getErrors()->redirectWithErrorsTransfer('index.php#'. DisplayWithErrorMessages::ERROR_ANCHOR_NAME);
			exit;
		}
	}

	/**
	 * @return \RqData\Process\ResultFileDownloader
	 */
	protected function getResultFileDownload() {
		return $this->resultFileDownload;
	}

	/**
	 * @return \RqData\Registry\Errors
	 */
	protected function getErrors() {
		return $this->errors;
	}
}