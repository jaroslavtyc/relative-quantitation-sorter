<?php
namespace RqData\Format;

class TextMerger {
	private $tinyButStrong;

	public function __construct(\clsTinyButStrong $tinyButStrong) {
		$this->tinyButStrong = $tinyButStrong;
		$this->setOpeningCharacter('{');
		$this->setClosingCharacter('}');
	}

	public function setOpeningCharacter($character) {
		$this->setOption('chr_open', $character);
	}

	public function setClosingCharacter($character) {
		$this->setOption('chr_close', $character);
	}

	public function loadTemplate($file) {
		$this->getTinyButStrong()->LoadTemplate($file);
	}

	public function mergeBlock($name, array $values) {
		$this->getTinyButStrong()->MergeBlock($name, $values);
	}

	public function getResult() {
		$this->getTinyButStrong()->Show(OPENTBS_STRING);
		return $this->getTinyButStrong()->Source;
	}

	public function getMimetype() {
		return $this->getTinyButStrong()->Charset[0]->ExtInfo['ctype'];
	}

	/**
	 * @return \clsTinyButStrong
	 */
	protected function getTinyButStrong() {
		return $this->tinyButStrong;
	}

	protected function setOption($name, $value) {
		$this->getTinyButStrong()->SetOption(array($name => $value));
	}
}