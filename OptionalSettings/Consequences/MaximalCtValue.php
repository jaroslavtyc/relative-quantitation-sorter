<?php
namespace RqData\OptionalSettings\Consequences;

class MaximalCtValue extends \universal\IterableTycClass {

	const CODE = 'consequencesOfCtMaximum';
	const HUMAN_NAME ='Úprava hodnot při dosažení maxima CT';

	protected $maximalCtValue;
	protected $replacementValueUnderMaximum;
	protected $replacementValueOverMaximum;
	protected $rqValueEdge;

	public function __construct() {
		$this->setSettings();
		$this->makeAllPropertiesReadable();
		parent::__construct(
			array($this->maximalCtValue,
				$this->replacementValueUnderMaximum,
				$this->replacementValueOverMaximum,
				$this->rqValueEdge)
		);
	}

	protected function setSettings() {
		$this->maximalCtValue = new Settings\MaximalCtValue;
		$this->replacementValueUnderMaximum = new Settings\ReplacementValueUnderMaximum;
		$this->replacementValueOverMaximum = new Settings\ReplacementValueOverMaximum;
		$this->rqValueEdge = new Settings\RqValueEdge;
	}
}