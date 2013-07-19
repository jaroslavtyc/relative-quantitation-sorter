<?php
namespace RqData\Process;

use RqData\Registry\UserErrors;
use RqData\RequiredSettings\File\FileWithData;
use RqData\Process\Exceptions\InputFileIsMissing;

class InputFile extends Base {

	protected $filesInformations;
	protected $uploadedFile;

	public function __construct(array $filesInformations, UserErrors $errors) {
		parent::__construct($errors);
		$this->filesInformations = new \ArrayObject($filesInformations);
	}

	public function process() {
		if (!$this->getFilesInformations()->offsetExists(FileWithData::FILE_NAME)) {
			$this->getErrors()->rememberError('chybí', 'Soubor');
			throw new InputFileIsMissing;
		} else {
			$fileInfo = $this->getFilesInformations()->offsetGet(FileWithData::FILE_NAME);
			if ($fileInfo['name'] == '') {
				$this->getErrors()->rememberError('chybí', 'Soubor');
				throw new InputFileIsMissing;
			}
		}
		$this->uploadedFile = new \universal\Folder\File\UploadedFile(FileWithData::FILE_NAME);
	}

	/**
	 * @return \universal\Folder\File\UploadedFile
	 */
	public function getUploadedFile() {
		return $this->uploadedFile;
	}

	/**
	 * @return \ArrayObject
	 */
	protected function getFilesInformations() {
		return $this->filesInformations;
	}
}