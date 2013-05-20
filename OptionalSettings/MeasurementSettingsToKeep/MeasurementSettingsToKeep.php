<?php
/*
 * Values used to set meauserement, needed to be saved for optional
 * human backward control
 */
class MeasurementSettingsToKeep extends IterableTycClass {

	const HUMAN_NAME = 'Uložení parametrů programu RQ Study';
	const CODE = 'measurementSettingsToKeep';

	protected $treshold;
	protected $baseline;

	public function __construct() {
		$this->setOptions();
		$this->makeAllPropertiesReadable();
		parent::__construct(array($this->treshold, $this->baseline));
	}

	protected function setOptions() {
		$this->treshold = new MeasurementTreshold;
		$this->baseline = new MeasurementBaseline;
	}
}