<?php
namespace RqData\Controllers;

error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');
require(__DIR__ . '/libraries/autoload.php');

$template = __DIR__ . '/testFiles/rqDataTemplate.ods';
$resultFile = __DIR__ . '/testFiles/rqDataFilled.ods';

if (file_exists($resultFile)) {
	unlink($resultFile);
}

$tbs = new \Format\FormatedDocumentMerger();
$tbs->LoadTemplate($template);
//$tbs->MergeBlock('calibrator', array(array('name' => 'kalibr', 'referenceGeneCtValue' => 15, 'referenceGeneRqValue' => 345, 'ctValue' => 123, 'rqValue' => 987)));
$tbs->Show(OPENTBS_DOWNLOAD, basename($resultFile));

/*
$controller = new Homepage();
$controller->display();
*/