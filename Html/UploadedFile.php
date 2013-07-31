<?php
namespace RqData\Html;

class UploadedFile extends \RqData\Core\Object {

	private $inputName;
	private $currentFilepath;
	private $tempFilepath;
	private $name;

	/**
	 * tempName ?
	 */
	public function __construct($inputName) {
		$this->inputName = $inputName;
		$this->tempFilepath = $_FILES[$this->inputName]['tmp_name'];
		$this->currentFilepath = $this->tempFilepath;
		$this->name = $_FILES[$this->inputName]['name'];
	}

	public function moveTo($destinationFilepath) {
		if (!move_uploaded_file($this->currentFilepath , $destinationFilepath)) {
			throw new \RqData\File\Exceptions\CopyOfFileFailed(sprintf('Destination [%s]', $destinationFilepath));
		} else {
			$this->currentFilepath = $destinationFilepath;
		}
	}

	public function getSize() {
		return filesize($this->currentFilepath);
	}

	public function getName() {
		return $this->name;
	}

	public function getContentArray() {
		$resource = fopen($this->currentFilepath, 'r');
		$content = array();
		while (!feof($resource)) {
			$content[] = fgets($resource);
		}

		return $content;
	}

	public function getTempFilename() {
		return basename($this->tempFilepath);
	}
}