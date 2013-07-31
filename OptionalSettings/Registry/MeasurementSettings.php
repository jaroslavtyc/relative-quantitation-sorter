<?php
namespace RqData\OptionalSettings\Registry;
/*
 * Values used to set meauserement, needed to be saved for optional
 * human backward control
 */
class MeasurementSettings extends \RqData\Core\Iterable {
	const HUMAN_NAME = 'Uložení parametrů programu RQ Study';
	const CODE = 'measurementSettingsToKeep';

	public function __construct() {
		parent::__construct($this->getSettingsToKeep());
	}

	private function getSettingsToKeep() {
		return array(new Settings\MeasurementTreshold, new Settings\MeasurementBaseline);
	}
}