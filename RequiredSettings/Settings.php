<?php
namespace RqData\RequiredSettings;

abstract class Settings extends \RqData\Core\Iterable implements \RqData\Html\SingleOption {
	public function __construct() {
		parent::__construct(array());
	}
}