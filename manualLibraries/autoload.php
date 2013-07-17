<?php
require_once __DIR__ . '/../libs/nette/loader.php';

date_default_timezone_set("Europe/Prague");

$loader = new Nette\Loaders\RobotLoader();
$loader->addDirectory(dirname(__FILE__)."/../FileDownloader");
$loader->addDirectory(dirname(__FILE__)."/../libs/BigFileTools");
$loader->register();

\Nette\Diagnostics\Debugger::enable(\Nette\Diagnostics\Debugger::DEVELOPMENT, APP_DIR."/log");

Nette\Environment::getContext()->cacheStorage = new Nette\Caching\Storages\FileStorage(APP_DIR.'/cache');

Nette\Environment::getHttpResponse()->setContentType("text/html", "UTF-8");