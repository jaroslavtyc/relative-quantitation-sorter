<?php
namespace RqData\History;

use RqData\Core\Object;
use RqData\Registry\UserErrors;
use RqData\History\Exceptions\DuplicitStructure;

/**
 * Reads history files of resource and result aswell, paired resource and result
 * files
 */
class File extends Object {

	/**
	 * List of file names indexed by time of rqdata calling, then by tempname
	 * (to avoid collision of history files saved by rqdata called simultaneously)
	 */
	protected $listOfFiles;
	private $errors;

	public function __construct(UserErrors $errors) {
		$this->errors = $errors;
	}

	public function getListOfFiles() {
		if (!(isset($this->listOfFiles))) {
			$this->setListOfFiles();
		}

		return $this->listOfFiles;
	}

	protected function setListOfFiles() {
		$this->listOfFiles = array();
		$unorderedFilenames = array('resource'=>array(), 'result'=>array());
		if (!\file_exists(FileUtilities::getUserResourceFileFolderPath())) {
			$this->getErrors()->rememberError('neexistuje','Adresář s historickými zdrojovými soubory');
		} else {
			$unorderedFilenames['resource'] = FolderUtilities::getFilesFromDir(FileUtilities::getUserResourceFileFolderPath());
		}

		if (!\file_exists(FileUtilities::getUserResultFileFolderPath())) {
			$this->getErrors()->rememberError('neexistuje','Adresář s historickými výslednými soubory');
		} else {
			$unorderedFilenames['result'] = FolderUtilities::getFilesFromDir(FileUtilities::getUserResultFileFolderPath());
		}

		foreach($unorderedFilenames as $type=>$baseFilenames) {
			foreach ($baseFilenames as $baseFilename) {
				$fileInfo = array();
				if (!\preg_match('~^(\d+)_([^_]+)_(\d+)_(.+)$~', $baseFilename, $fileInfo)) {
					$this->getErrors()->rememberError('soubor  ' . $fileInfo . 'nesplňuje požadavky na název','Chybný formát názvu');
					continue;
				}

				if (!isset($this->listOfFiles[$fileInfo[1]])) {
					$this->listOfFiles[$fileInfo[1]] = array();
				}
				$sameTime = &$this->listOfFiles[$fileInfo[1]];
				if (!isset($sameTime[$fileInfo[2]])) {
					$sameTime[$fileInfo[2]] = array();
				}
				$sameTimeTempname = &$sameTime[$fileInfo[2]];
				if (!isset($sameTimeTempname[$type])) {
					$sameTimeTempname[$type] = array('name' => $fileInfo[4], 'size' => $fileInfo[3]);
				} else {
					throw new DuplicitStructure(sprintf('History file name [%s] of type [%s].', $baseFilename, $type));
				}
			}
		}

		\krsort($this->listOfFiles);
	}

	/**
	 * @return UserErrors
	 */
	protected function getErrors() {
		return $this->errors;
	}
}