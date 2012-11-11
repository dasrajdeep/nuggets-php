<?php

session_start();

ini_set('display_errors',false);
set_error_handler('defaultNuggetsHandler');

require_once('core/NuggetsRegistry.php');
require_once('core/Engine.php');
require_once('core/Command.php');
require_once('core/Dispatcher.php');
require_once('core/Config.php');
require_once('core/Session.php');

Session::init();
NuggetsRegistry::init();
Config::init();

?>

<?php

 function defaultNuggetsHandler($level,$message,$filename,$line) {
	$msg=nuggetsCreateMessage(func_get_args());
	require_once('static/errorDefault.php');
	die();
}

function nuggetsFetchLevel($value) {
	$errorLevels=array(1=>'FATAL',2=>'WARNING',4=>'PARSE',8=>'NOTICE');
	if($value<10) return $errorLevels[$value];
	else return 'INTERNAL';
}

function nuggetsCreateMessage($args) {
	$level=nuggetsFetchLevel($args[0]);
	$message=$args[1];
	$file=$args[2];
	$line=$args[3];
	$error='['.$level.'] '.$message.' (at file: '.$file.', line '.$line.')';
	return $error;
}

?>