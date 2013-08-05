<?php
namespace RqData\RequiredSettings\Options;

use RqData\RequiredSettings\File\FileWithRqData;
use RqData\RequiredSettings\File\FileWithoutRqData;

/**
 * Keeper of work / file types
 */
class Operations extends RequiredSettings {
	const HUMAN_NAME = 'určení obsahu souboru';
	const CODE = 'operationType';
	const VALUE = '';

	private $operations;

	public function __construct() {
		$this->initializeOperations();
		parent::__construct($this->operations);
	}

	private function initializeOperations() {
		$fileWithRqData = new FileWithRqData();
		$fileWithoutRqData = new FileWithoutRqData();
		$this->operations = array(
			$fileWithRqData->getOptionMask() => $fileWithRqData,
			$fileWithoutRqData->getOptionMask() => $fileWithoutRqData
		);
	}

	/**
	 * Check code against known integer-binary valid codes
	 *
	 * @param int $intBinKey
	 * @return bool
	 */
	public function isOperation($intBinKey) {
		return isset($this->operations[$intBinKey]);
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

		return $this->operations[$intBinKey];
	}
}