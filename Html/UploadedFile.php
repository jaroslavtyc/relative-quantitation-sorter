<?php
namespace RqData\Html;

class UploadedFile {

	/**
	 * tempName ?
	 */
	public function __construct($inputName) {
		$this->setInputName($inputName);
	}

	public function moveTo($destinationFilepath) {
		if (!move_uploaded_file($this->tempName , $destinationFilepath)) {
			throw new \RqData\File\Exceptions\CopyOfFileFailed(sprintf('Destination [%s]', $destinationFilepath));
		}
	}

	public function getSize() {

	}

	public function getName() {

	}

	public function getContentArray() {

	}

	public function getTempFilename() {

	}
}