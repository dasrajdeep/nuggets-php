<?php

session_start();

ini_set('display_errors',false);
set_error_handler('defaultHandler');

require_once('core/Registry.php');
require_once('core/Engine.php');
require_once('core/Command.php');
require_once('core/Dispatcher.php');
require_once('core/Config.php');
require_once('core/Session.php');

Session::init();
Registry::init();
Config::init();

?>

<?php

 function defaultHandler($level,$message,$filename,$line) {
	$msg=createMessage(func_get_args());
	require_once('static/errorDefault.php');
	die();
}

function fetchLevel($value) {
	$errorLevels=array(1=>'FATAL',2=>'WARNING',4=>'PARSE',8=>'NOTICE');
	if($value<10) return $errorLevels[$value];
	else return 'INTERNAL';
}

function createMessage($args) {
	$level=fetchLevel($args[0]);
	$message=$args[1];
	$file=$args[2];
	$line=$args[3];
	$error='['.$level.'] '.$message.' (at file: '.$file.', line '.$line.')';
	return $error;
}

?>