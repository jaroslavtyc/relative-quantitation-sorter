<?php
namespace RqData\RequiredSettings\File;
/**
 * Base of classses describing file content.
 */
abstract class WithData extends \RqData\RequiredSettings\Options\RequiredSettings {
	const FILE_NAME = 'rozmeryBrebery';

	/**
	 * Interger-binary code representing required columns in file
	 */
	protected $optionMask;

	/**
	 * Additional settings extending selected file setting
	 */
	private $listOfExtendingSettings;

	public function __construct($optionMask) {
		$this->setOptionMask($optionMask);
		$this->initializeListOfExtendingSettings();
		$this->makePropertiesReadable('optionMask', 'listOfExtendingSettings');
		parent::__construct(array(), $this->listOfExtendingSettings);
	}

	public function getOptionMask() {
		return $this->optionMask;
	}

	abstract protected function initializeListOfExtendingSettings();

	protected function setListOfExtendedSettings(array $extendedSetings) {
		$this->listOfExtendingSettings = $extendedSetings;
	}

	public function getListOfExtendingSettings() {
		return $this->listOfExtendingSettings;
	}

	protected function setOptionMask($optionMask) {
		$this->optionMask = $optionMask;
	}
}