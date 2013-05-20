<?php
namespace RqData\RequiredSettings\File;
/**
 * base of classses describing file content
 *
 */
abstract class FileWithData extends \RqData\RequiredSettings\Options\RequiredSettings {

	const FILE_NAME = 'rozmeryBrebery';

	/**
	 * Interger-binary code representing required columns in file
	 *
	 * @var int
	 */
	protected $optionMask;

	/**
	 * Additional settings extending selected file setting
	 *
	 * @var array
	 */
	protected $listOfExtendingSettings;

	/**
	 * Require integer-binary map representing required columns in file
	 *
	 * @param int $optionMask
	 */
	public function __construct($optionMask) {
		$this->setOptionMask($optionMask);
		$this->setListOfExtendingSettings();
		$this->makePropertiesReadable('optionMask', 'listOfExtendingSettings');
		parent::__construct(array(), $this->listOfExtendingSettings);
	}

	protected function setListOfExtendingSettings() {
		$this->listOfExtendingSettings = array();
	}

	public function getListOfExtendingSettings() {
		return $this->listOfExtendingSettings;
	}

	/**
	 * Setter of interger-binary option mask
	 */
	protected function setOptionMask($optionMask) {
		$this->optionMask = $optionMask;
	}
}