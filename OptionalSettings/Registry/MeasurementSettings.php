<?php
namespace RqData\OptionalSettings\Registry;
/*
 * Values used to set meauserement, needed to be saved for optional
 * human backward control
 */
class MeasurementSettings extends \universal\IterableTycClass {

	const HUMAN_NAME = 'Uložení parametrů programu RQ Study';
	const CODE = 'measurementSettingsToKeep';

	protected $treshold;
	protected $baseline;

	public function __construct() {
		$this->setSettings();
		$this->makeAllPropertiesReadable();
		parent::__construct(array($this->treshold, $this->baseline));
	}

	protected function setSettings() {
		$this->treshold = new Settings\MeasurementTreshold;
		$this->baseline = new Settings\MeasurementBaseline;
	}
}