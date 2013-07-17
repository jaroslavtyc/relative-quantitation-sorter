<?php
namespace RqData\Format;

class FormatedDocumentMerger extends TextMerger {

	public function __construct(\clsTinyButStrong $tinyButStrong) {
		parent::__construct($tinyButStrong);
		$this->getTinyButStrong()->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
	}
}