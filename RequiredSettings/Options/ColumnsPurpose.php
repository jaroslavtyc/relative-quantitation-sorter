<?php
namespace RqData\RequiredSettings\Options;

class ColumnsPurpose extends RequiredSettings {

	const HUMAN_NAME = 'požadovaná posloupnost sloupců';
	const CODE = 'columnsPurpose';
	const VALUE = '';

	/**
	 *
	 * @var int bitwise map expressed by integer representing acceptable column
	 * purpose
	 */
	protected $optionMask;

	/**
	 *
	 * @var array
	 */
	protected $columnsPurpose = array();

	/**
	 * List of all possible columns, apart of option mask
	 *
	 * @var array
	 */
	private static $possibleColumnsPurpose = array(
		self::SUBJECT_NAME => array('subjectNames'=>'jména lidí')
		,self::GENE_NAMES => array('geneNames'=>'názvy genů')
		,self::CT_VALUES => array('ctValues'=>'hodnoty Ct')
		,self::RQ_VALUES => array('rqValues'=>'hodnoty RQ')
	);

	/**
	 * List of all available columns and their "numericity"
	 *
	 * @var array
	 */
	private $listOfIsColumnsNumeric = array();

	/**
	 * Require bitwise map converted to integer, representing acceptable
	 * purpose of columns
	 *
	 * @param int $optionMask
	 */
	public function __construct($optionMask) {
		$this->setOptionMask($optionMask);
		$this->makePropertyReadable('optionMask');
		$this->setColumnsPurpose();
		parent::__construct($this->columnsPurpose);
	}

	/**
	 * Check if given integer-binary key, respective him reperesented column
	 * should contain only numeric values
	 *
	 * @param int $intBinKey
	 * @throws Exception in case of unknown integer-binary key
	 * @return bool
	 */
	public static function isIntbinKeyedColumnNumeric($intBinKey){
		if (in_array($intBinKey, array(self::SUBJECT_NAME, self::GENE_NAMES)))
			return FALSE;

		if (in_array($intBinKey, array(self::CT_VALUES, self::RQ_VALUES)))
			return TRUE;

		throw new \Exception('Unknown intBin keys of column purpose', E_WARNING);
	}

	/**
	 * Count number of all possible columns, apart of option mask
	 *
	 * @return int
	 */
	public static function getNumberOfPossibleColumns() {
		return sizeof(self::$possibleColumnsPurpose);
	}

	/**
	 * Intersection of option integer-binary mask and integer-binary representation
	 * of RQ values option
	 *
	 * @return bool
	 */
	public function isRqdataInvolved() {
		//bitwise AND
		return (bool)($this->optionMask
		 & self::RQ_VALUES);
	}

	/**
	 * Getter of column code and human name, identified by integer-binary key
	 *
	 * @param int $intBinKey
	 * @return array
	 */
	public function getColumnName($intBinKey){
		return $this->columnsPurpose[$intBinKey];
	}

	/**
	 * Check if asked column is listed in numeric columns
	 *
	 * @param int $level interger index of column, started by zero
	 * @return bool
	 */
	public function isColumnNumeric($level){
		if ($level > (sizeof($this->columnsPurpose) -1)) {
			throw new \Exception('Asked position (' . $level . ') of column purpose is out of list', E_WARNING);
		}

		if (!isset($this->listOfIsColumnsNumeric[$level])) {
			$this->setListOfIsColumnsNumeric();
		}

		return $this->listOfIsColumnsNumeric[$level];
	}

	/**
	 * Count number of acceptable columns
	 *
	 * @return int
	 */
	public function getNumberOfColumns() {
		return $this->getSize();
	}

	//------ INNER FACILITIES ------

	/**
	 * Setter for list of all columns and information about their "numericity"
	 */
	private function setListOfIsColumnsNumeric() {
		foreach (array_keys($this->columnsPurpose) as $level=>$intBinKey) {
			$this->listOfIsColumnsNumeric[$level] =
				self::isIntbinKeyedColumnNumeric($intBinKey);
		}
	}

	/**
	 * Setter of option mask
	 *
	 * @param int $optionMask
	 */
	private function setOptionMask($optionMask){
		if (!is_numeric($optionMask)) {
			throw new \Exception('Mask of options has to contain numbers representing content of data');
		}

		$this->optionMask = $optionMask;
	}

	/**
	 * Setter of columnns purpose according to option mask
	 */
	private function setColumnsPurpose(){
		if (!isset($this->optionMask)) {
			throw new \Exception('Option mask has to be setted before setting
				purpose of columns');
		}

		foreach(self::$possibleColumnsPurpose as $intBinKey=>$purpose){
			if ($intBinKey & $this->optionMask) {
				$this->columnsPurpose[$intBinKey] = $purpose;
			}
		}
	}
}