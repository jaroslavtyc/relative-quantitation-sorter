<?php
namespace RqData\Controllers;

error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');

$controller = new Homepage();
$controller->display();
