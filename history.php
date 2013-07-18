<?php
namespace RqData\Frontend\Controllers;

use RqData\View\SmartyFetcher;

error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');

$smarty = new \Smarty;
$fetcher = new SmartyFetcher($smarty, 'history.tpl');
$history = new History($fetcher);
$history->display();