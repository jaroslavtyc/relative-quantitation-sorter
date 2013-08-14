<?php
namespace RqData\Frontend\Controllers;

use RqData\View\SmartyFetcher;

error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');

$smarty = new \Smarty;
$smarty->addPluginsDir(__DIR__ . '/View/Functions');
$smarty->addConfigDir(__DIR__ . '/Frontend/settings');
$smarty->setCompileDir(__DIR__ . '/Frontend/templates_c');
$fetcher = new SmartyFetcher($smarty, __DIR__ . '/Frontend/Templates/history.tpl');
$authenticator = new \RqData\Security\Authenticator(new \ArrayObject(array('irbr' => 'rqdata')));
$user = new \RqData\Security\User(
	$authenticator,
	isset($_POST['login']) ? $_POST['login'] : FALSE,
	isset($_POST['password']) ? $_POST['password'] : FALSE
);
$history = new History($fetcher, $user);
$history->display();
