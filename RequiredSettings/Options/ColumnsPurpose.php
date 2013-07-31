<?php
namespace RqData\RequiredSettings\Options;

class ColumnsPurpose extends RequiredSettings {
	const HUMAN_NAME = 'požadovaná posloupnost sloupců';
	const CODE = 'columnsPurpose';
	const VALUE = '';

	protected $optionMask;
	protected $columnsPurpose = array();

	private static $possibleColumnsPurpose = array(
		self::SUBJECT_NAME => array('subjectNames' => 'jména lidí')
		,self::GENE_NAMES => array('geneNames' => 'názvy genů')
		,self::CT_VALUES => array('ctValues' => 'hodnoty Ct')
		,self::RQ_VALUES => array('rqValues' => 'hodnoty RQ')
	);

	private $listOfIsColumnsNumeric = array();

	public function __construct($optionMask) {
		$this->setOptionMask($optionMask);
		$this->makePropertyReadable('optionMask');
		$this->initializeColumnsPurpose();
		parent::__construct($this->columnsPurpose);
	}

	/**
	 * Check if given integer-binary key, respective him reperesented column should contain only numeric values.
	 */
	public static function isIntbinKeyedColumnNumeric($intBinKey){
		if (\in_array($intBinKey, array(self::SUBJECT_NAME, self::GENE_NAMES))) {
			return FALSE;
		} elseif (in_array($intBinKey, array(self::CT_VALUES, self::RQ_VALUES))) {
			return TRUE;
		} else {
			throw new Exceptions\UnkownIntBinKey(var_export($intBinKey, TRUE));
		}
	}

	public static function getNumberOfPossibleColumns() {
		return \count(self::$possibleColumnsPurpose);
	}

	/**
	 * Intersection of option integer-binary mask and integer-binary representation of RQ values option.
	 */
	public function isRqdataInvolved() {
		// bitwise AND
		return (bool) ($this->optionMask & self::RQ_VALUES);
	}

	/**
	 * Getter of column code and human name, identified by integer-binary key
	 */
	public function getColumnName($intBinKey){
		return $this->columnsPurpose[$intBinKey];
	}

	/**
	 * Check if asked column is listed in numeric columns
	 */
	public function isColumnNumeric($level){
		if ($level > (\count($this->columnsPurpose) -1)) {
			throw new Exceptions\OutOfColumnsPurposeList(sprintf('Required position [%s].', $level));
		}

		if (!isset($this->listOfIsColumnsNumeric[$level])) {
			$this->setListOfIsColumnsNumeric();
		}

		return $this->listOfIsColumnsNumeric[$level];
	}

	public function getNumberOfColumns() {
		return $this->getSize();
	}

	/**
	 * Setter for list of all columns and information about their "numericity"
	 */
	private function setListOfIsColumnsNumeric() {
		foreach (\array_keys($this->columnsPurpose) as $level=>$intBinKey) {
			$this->listOfIsColumnsNumeric[$level] = self::isIntbinKeyedColumnNumeric($intBinKey);
		}
	}

	private function setOptionMask($optionMask){
		if (!\is_numeric($optionMask)) {
			throw new Exceptions\OptionMaskIsNotNumeric(var_export($optionMask, TRUE));
		}

		$this->optionMask = $optionMask;
	}

	private function initializeColumnsPurpose(){
		foreach(self::$possibleColumnsPurpose as $intBinKey=>$purpose){
			if ($intBinKey & $this->optionMask) {
				$this->columnsPurpose[$intBinKey] = $purpose;
			}
		}
	}
}