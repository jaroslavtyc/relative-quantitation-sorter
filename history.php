<?php
namespace RqData\Controllers;

error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');

$history = new History();
$history->display();