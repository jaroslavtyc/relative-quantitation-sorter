<?php
namespace RqData\Process;
error_reporting(-1);
require(__DIR__ . '/../universal/autoload.php');

$errors = new \RqData\Registry\UserErrors();
$formStateKeeper = new \RqData\Registry\FormStateKeeper();
$formStateKeeper->holdFormStates($_POST);
$inputSettingsValues = new \ArrayObject($_POST);
$inputFile = new InputFile($_FILES, $errors);
$settings = new Settings($inputSettingsValues, $errors);
$inputValues = new InputValues($inputFile, $settings, $errors);
$format = new Format($inputValues, $errors);
$result = new Result($format, $errors);
$resultFileDownload = new ResultFileDownloader($result, $errors);

$process = new \RqData\Frontend\Controllers\DataTransform($resultFileDownload, $errors);
$process->run();
