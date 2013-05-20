<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/universal/autoload.php');

$requirements = array(
	array('sourcePath' => '/universal/templates/base.tpl', 'linkName' => '/rqdata/ajax/templates/base.tpl'),
	array('sourcePath' => '/universal/templates/base.tpl', 'linkName' => '/rqdata/templates/base.tpl'),
	array('sourcePath' => '/universal/templates/index.tpl', 'linkName' => '/rqdata/templates/index.tpl'),
	array('sourcePath' => '/universal/js/system/checks.js', 'linkName' => '/rqdata/js/system/checks.js'),
	array('sourcePath' => '/universal/js/libs/jquery.js', 'linkName' => '/rqdata/js/libs/jquery.js'),
);
$symlink = new Symlink;
foreach($requirements as $requirement){
	echo $requirement['linkName'] . ' - ' .$symlink->make(
		$_SERVER['DOCUMENT_ROOT'] . $requirement['sourcePath'],//original folder
		$_SERVER['DOCUMENT_ROOT'] . $requirement['linkName'],//final name of link
		Symlink::REWRITE_LINK | Symlink::REWRITE_FILE | Symlink::REWRITE_DIR //for this kind of link-creation we need overwrite everythink what was hard-copied after ftp transfer
	) . '<br />';
}
