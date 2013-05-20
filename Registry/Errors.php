<?php
namespace RqData\Registry;

class Errors extends \HtmlChyby {

	private static $instance;

	public static function get() {
		if(!isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}