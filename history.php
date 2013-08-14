<?php
namespace RqData\Frontend\Controllers;

use RqData\View\SmartyFetcher;

error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');

$smarty = new \Smarty;
$smarty->addPluginsDir(__DIR__ . '/View/Functions');
$smarty->addConfigDir(__DIR__ . '/Frontend/settings');
$fetcher = new SmartyFetcher($smarty, __DIR__ . '/Frontend/Templates/history.tpl');
$history = new History($fetcher);
$history->display();