<?php
namespace RqData\History;

use RqData\Registry\Errors;
/**
 * Reads history files of resource and result aswell, paired resource and result
 * files
 */
class File extends \UniversalClass {

	/**
	 * List of file names indexed by time of rqdata calling, then by tempname
	 * (to avoid collision of history files saved by rqdata called simultaneously)
	 *
	 * @var array
	 */
	protected $listOfFiles;
	private $errors;

	public function __construct() {
		$this->makePropertyReadable('listOfFiles');
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
		if (!file_exists(FileUtilities::getUserResourceFileFolderPath())) {
			$this->getErrors()->zapamatujChybu('neexistuje','Adresář s historickými zdrojovými soubory');
		} else {
			$unorderedFilenames['resource'] = FolderUtilities::getFilesFromDir(
				FileUtilities::getUserResourceFileFolderPath());
		}

		if (!file_exists(FileUtilities::getUserResultFileFolderPath())) {
			$this->getErrors()->zapamatujChybu('neexistuje','Adresář s historickými výslednými soubory');
		} else {
			$unorderedFilenames['result'] = FolderUtilities::getFilesFromDir(
				FileUtilities::getUserResultFileFolderPath());
		}

		foreach($unorderedFilenames as $type=>$baseFilenames) {
			foreach ($baseFilenames as $baseFilename) {
				if (!preg_match('~^(\d+)_([^_]+)_(\d+)_(.+)$~', $baseFilename, $fileInfo)) {
					$this->getErrors()->zapamatujChybu('soubor  ' . $fileInfo . 'nesplňuje požadavky na název','Chybný formát názvu');
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
					throw new Exception('Duplicit structure of history file name "' . $baseFilename . '" of type ' . $type, E_USER_ERROR);
				}
			}
		}

		krsort($this->listOfFiles);
	}

	/**
	 * @return Errors
	 */
	protected function getErrors() {
		if (!isset($this->errors)) {
			$this->errors = Errors::get();
		}
		return $this->errors;
	}
}