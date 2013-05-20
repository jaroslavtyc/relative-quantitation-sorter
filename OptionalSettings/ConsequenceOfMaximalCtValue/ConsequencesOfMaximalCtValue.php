<?php
class ConsequencesOfMaximalCtValue extends IterableTycClass {

	const CODE = 'consequencesOfCtMaximum';
	const HUMAN_NAME ='Úprava hodnot při dosažení maxima CT';

	protected $maximalCtValue;
	protected $replacementValueUnderMaximum;
	protected $replacementValueOverMaximum;
	protected $rqValueEdge;

	public function __construct() {
		$this->setOptions();
		$this->makeAllPropertiesReadable();
		parent::__construct(
			array($this->maximalCtValue,
				$this->replacementValueUnderMaximum,
				$this->replacementValueOverMaximum,
				$this->rqValueEdge)
		);
	}

	protected function setOptions() {
		$this->maximalCtValue = new MaximalCtValue;
		$this->replacementValueUnderMaximum = new ReplacementValueUnderMaximum;
		$this->replacementValueOverMaximum = new ReplacementValueOverMaximum;
		$this->rqValueEdge = new RqValueEdge;
	}
}