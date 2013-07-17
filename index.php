<?php
namespace RqData\Controllers;

error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');
require(__DIR__ . '/libraries/autoload.php');

require_once __DIR__ . '/libraries/mbence/opentbs-bundle/MBence/OpenTBSBundle/lib/tbs_class.php';


$template = __DIR__ . '/testFiles/rqDataTemplate.ods';
$resultFile = __DIR__ . '/testFiles/rqDataFilled.ods';

if (file_exists($resultFile)) {
	unlink($resultFile);
}

$tinyButStrong = new \clsTinyButStrong();
$formater = new \Format\FormatedDocumentMerger($tinyButStrong);
$formater->loadTemplate($template);
$formater->mergeBlock('calibrator', new \ArrayObject());
var_dump($tinyButStrong);die;
var_dump(file_put_contents($resultFile, $formater->getResult()));
var_dump(file_exists($resultFile));
die($resultFile);
$formater->Show(OPENTBS_DOWNLOAD, basename($resultFile));

/*
$controller = new Homepage();
$controller->display();
*/