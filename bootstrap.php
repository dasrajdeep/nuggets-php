<?php

namespace nuggets;

define('DS',DIRECTORY_SEPARATOR);

session_start();

$basePath=getcwd();

ini_set('display_errors',false);
set_error_handler('nuggets\defaultErrorHandler');

require_once('core/Registry.php');
require_once('core/Engine.php');
require_once('core/Command.php');
require_once('core/Dispatcher.php');
require_once('core/Config.php');
require_once('core/Session.php');

Session::init();
Registry::init();
Config::init();

$includePaths=array(
	'core',
	'core'.DS.'Authentication',
	'core'.DS.'Controller',
	'core'.DS.'Helper',
	'core'.DS.'Mailer',
	'core'.DS.'Model',
	'core'.DS.'View',
	'app'.DS.'model',
	'app'.DS.'view',
	'app'.DS.'controller',
	'app'.DS.'extensions'
);
foreach($includePaths as &$i) $i=$basePath.DS.$i;
array_push($includePaths,get_include_path());

set_include_path(implode(PATH_SEPARATOR,$includePaths));

spl_autoload_register('nuggets\nuggetsClassLoader',false);

register_shutdown_function('nuggets\nuggetsShutdown');

function nuggetsClassLoader($class) {
	if(strpos($class,'nuggets')!==false) $class=substr($class,8);
	$classPath=$class.'.php';
	require_once($classPath);
}

function nuggetsShutdown() {
	$error=error_get_last();
	if($error) call_user_func_array('nuggets\defaultErrorHandler',array_values($error));
}

?>

<?php
 namespace nuggets;
 
 function defaultErrorHandler($level,$message,$filename,$line) {
	$msg=createErrorMessage(func_get_args());
	require_once('static/errorDefault.php');
	die();
}

function fetchErrorLevel($value) {
	$errorLevels=array(1=>'FATAL',2=>'WARNING',4=>'PARSE',8=>'NOTICE');
	if($value<10) return $errorLevels[$value];
	else return 'INTERNAL';
}

function createErrorMessage($args) {
	$level=fetchErrorLevel($args[0]);
	$message=$args[1];
	$file=$args[2];
	$line=$args[3];
	$error='<table align="center"><tr><th>'.$level.'</th><td>'.$message.' *(at file: '.$file.', line '.$line.')*</td></tr></table>';
	return $error;
}

?>