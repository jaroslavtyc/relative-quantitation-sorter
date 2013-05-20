<?php
namespace RqData\RequiredSettings\Options;
/**
 * Base for classes with options of work types and input file content
 *
 */
abstract class RequiredSettings extends \HtmlInputModel {

	const SUBJECT_NAME = 1; //b1
	const GENE_NAMES = 2; //b10
	const CT_VALUES = 4; //b100
	const RQ_VALUES = 8; //1000
	const ALL = 15; //b1111

	/**
	 * List of extending settings, required toghether with actual main setting
	 *
	 * @var array
	 */
	protected $dependentSettings;

	/**
	 *
	 * @param array $data
	 * @param array $dependentSettings
	 */
	public function __construct(array $data, array $dependentSettings = array()){
		parent::__construct($data);
		$this->setDependentSettings($dependentSettings);
		$this->makePropertyReadable('dependentSettings');
	}

	/**
	 * Setter for list of extending, required settings
	 *
	 * @param array $dependentSettings
	 */
	private function setDependentSettings(array $dependentSettings) {
		$this->dependentSettings = $dependentSettings;
	}
}