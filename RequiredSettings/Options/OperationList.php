<?php
namespace RqData\RequiredSettings\Options;

use RqData\RequiredSettings\File\FileWithRqData;
use RqData\RequiredSettings\File\FileWithoutRqData;

/**
 * Keeper of work / file types
 */
class OperationList extends RequiredSettings {

	const HUMAN_NAME = 'určení obsahu souboru';
	const CODE = 'operationType';
	const VALUE = '';

	private $operationList;

	public function __construct() {
		$this->initializeOperationList();
		parent::__construct($this->operationList);
	}

	/**
	 * Check code against known integer-binary valid codes
	 *
	 * @param int $intBinKey
	 * @return bool
	 */
	public function isOperation($intBinKey) {
		return isset($this->operationList[$intBinKey]);
	}

	/**
	 * Return operation identified by integer-binary key
	 *
	 * @param int $intBinKey
	 * @return FileWithData
	 */
	public function getOperation($intBinKey) {
		if (!$this->isOperation($intBinKey)) {
			return FALSE;
		}

		return $this->operationList[$intBinKey];
	}

	/**
	 * Sets types of available operations
	 */
	private function initializeOperationList() {
		$fileWithRqData = new FileWithRqData();
		$fileWithoutRqData = new FileWithoutRqData();
		$this->operationList = array(
			$fileWithRqData->optionMask => $fileWithRqData,
			$fileWithoutRqData->optionMask => $fileWithoutRqData
		);
	}
}