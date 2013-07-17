<?php
namespace RqData\RequiredSettings\Options;
/**
 * Base for classes with options of work types and input file content
 */
abstract class RequiredSettings extends \RqData\Core\Iterable {

	const SUBJECT_NAME = 1; //b1
	const GENE_NAMES = 2; //b10
	const CT_VALUES = 4; //b100
	const RQ_VALUES = 8; //1000
	const ALL = 15; //b1111

	/**
	 * List of extending settings, required toghether with actual main setting
	 */
	protected $dependentSettings;

	public function __construct(array $data, array $dependentSettings = array()){
		parent::__construct($data);
		$this->setDependentSettings($dependentSettings);
	}

	private function setDependentSettings(array $dependentSettings) {
		$this->dependentSettings = $dependentSettings;
	}

	public function getDependentSettings() {
		return $this->dependentSettings;
	}
}