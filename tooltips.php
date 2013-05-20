<?php
namespace RqData\Tooltips;

error_reporting(-1);
require_once(__DIR__ . '/../universal/autoload.php');

if (!empty($_GET['tooltip'])) {
	$tooltips = new Tooltips();
	$tooltips->displayTooltip($_GET['tooltip']);
}