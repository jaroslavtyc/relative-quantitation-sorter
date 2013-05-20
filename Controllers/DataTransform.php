<?php
namespace RqData\Controllers;

use RqData\Debugging\UserException;

class DataTransform {

	private $resultFileDownload;

	public function __construct(
		\RqData\Process\ResultFileDownloader $resultFileDownload,
		\RqData\Registry\Errors $errors
	) {
		$this->resultFileDownload = $resultFileDownload;
		$this->errors = $errors;
	}

	public function run() {
		try {
			$this->getResultFileDownload()->process();
		} catch (UserException $exception) {
			$this->getErrors()->navratSChybami('index.php#'. DisplayWithErrorMessages::ERROR_ANCHOR_NAME);
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