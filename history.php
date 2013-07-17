<?php
namespace RqData\Frontend\Controllers;

use \RqData\View\HistoryFetcher;

error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');

$smarty = new \Smarty;
$fetcher = new HistoryFetcher($smarty);
$history = new History($fetcher);
$history->display();