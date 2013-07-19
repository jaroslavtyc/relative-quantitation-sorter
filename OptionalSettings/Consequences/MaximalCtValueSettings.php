<?php
namespace RqData\OptionalSettings\Consequences;

class MaximalCtValueSettings extends RqData\Core\Object {

	const CODE = 'consequencesOfCtMaximum';
	const HUMAN_NAME ='Úprava hodnot při dosažení maxima CT';

	protected $maximalCtValue;
	protected $replacementValueUnderMaximum;
	protected $replacementValueOverMaximum;
	protected $rqValueEdge;

	public function __construct() {
		$this->setSettings();
	}

	protected function setSettings() {
		$this->maximalCtValue = new Settings\MaximalCtValue;
		$this->replacementValueUnderMaximum = new Settings\ReplacementValueUnderMaximum;
		$this->replacementValueOverMaximum = new Settings\ReplacementValueOverMaximum;
		$this->rqValueEdge = new Settings\RqValueEdge;
	}

	public function getMaximalCtValue() {
		return $this->maximalCtValue;
	}

	public function getReplacementValueUnderMaximum() {
		return $this->replacementValueUnderMaximum;
	}

	public function getReplacementValueOverMaximum() {
		return $this->replacementValueOverMaximum;
	}

	public function getRqValueEdge() {
		return $this->rqValueEdge;
	}
}