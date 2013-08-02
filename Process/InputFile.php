<?php
namespace RqData\Process;

use RqData\Registry\UserErrors;
use RqData\RequiredSettings\File\WithData;

class InputFile extends Base {
	private $filesInformations;
	private $uploadedFile;

	public function __construct(array $filesInformations, UserErrors $errors) {
		parent::__construct($errors);
		$this->filesInformations = new \ArrayObject($filesInformations);
	}

	public function process() {
		if (!$this->getFilesInformations()->offsetExists(WithData::FILE_NAME)) {
			$this->getErrors()->rememberError('chybí', 'Soubor');
			throw new Exceptions\InputFileIsMissing;
		} else {
			$fileInfo = $this->getFilesInformations()->offsetGet(WithData::FILE_NAME);
			if ($fileInfo['name'] === '') {
				$this->getErrors()->rememberError('chybí', 'Soubor');
				throw new Exceptions\InputFileIsMissing;
			} else {
				$this->uploadedFile = new \RqData\Html\UploadedFile(WithData::FILE_NAME);
			}
		}
	}

	public function moveTo($destinationFilepath) {
		$this->getUploadedFile()->moveTo($destinationFilepath);
	}

	public function getSize() {
		$this->getUploadedFile()->getSize();
	}

	public function getName() {
		$this->getUploadedFile()->getName();
	}

	public function getContentArray() {
		$this->getUploadedFile()->getContentArray();
	}

	public function getTempFilename() {
		$this->getUploadedFile()->getTempFilename();
	}

	/**
	 * @return \RqData\Html\UploadedFile
	 */
	private function getUploadedFile() {
		return $this->uploadedFile;
	}

	/**
	 * @return \ArrayObject
	 */
	private function getFilesInformations() {
		return $this->filesInformations;
	}
}