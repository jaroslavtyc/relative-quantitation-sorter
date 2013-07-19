<?php
namespace RqData\Frontend\Controllers;

use \RqData\Process\ResultFileDownloader;
use \RqData\Registry\UserErrors;
use RqData\Debugging\Exceptions\User;

class DataTransform {

	private $resultFileDownload;

	public function __construct(
		ResultFileDownloader $resultFileDownload,
		UserErrors $errors
	) {
		$this->resultFileDownload = $resultFileDownload;
		$this->errors = $errors;
	}

	public function run() {
		try {
			$this->getResultFileDownload()->process();
		} catch (User $exception) {
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
	 * @return \RqData\Registry\UserErrors
	 */
	protected function getErrors() {
		return $this->errors;
	}
}