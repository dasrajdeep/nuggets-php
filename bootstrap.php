<?php
/**
 * This file contains the bootstrap loader for the framework.
 * 
 * PHP version 5.3
 * 
 * LICENSE: This file is part of Nuggets-PHP.
 * Nuggets-PHP is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * Nuggets-PHP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Nuggets-PHP. If not, see <http://www.gnu.org/licenses/>. 
 */
namespace nuggets;

define('DS',DIRECTORY_SEPARATOR);

//ini_set('display_errors',false);

session_start();

$basePath=getcwd();

$logFile=fopen('nuggets.log','a+');
if(!$logFile) defaultErrorHandler(2,'Possible lack of permissions','Bootstrap',27);

set_error_handler('nuggets\defaultErrorHandler');

require_once('core/Registry.php');
require_once('core/Engine.php');
require_once('core/Command.php');
require_once('core/Dispatcher.php');
require_once('core/Config.php');
require_once('core/Session.php');
require_once('core/Extension.php');

register_shutdown_function('nuggets\nuggetsShutdown');

Session::init();
Config::init();
Registry::init();
Extension::init();

$initialized=true;

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
$includePaths=array_merge((array)get_include_path(),$includePaths);

set_include_path(implode(PATH_SEPARATOR,$includePaths));

spl_autoload_register('nuggets\nuggetsClassLoader',false);

/**
 * Logs events to a file.
 * 
 * @param string $message
 */
function logEvent($message) {
	$time=date('d-m-Y h:i:s a');
	fwrite($GLOBALS['logFile'],sprintf("[%s] %s\n",$time,$message));
}

/**
 * A custom class loader for the framework.
 * 
 * @param string $class
 */
function nuggetsClassLoader($class) {
	if(strpos($class,'nuggets')!==false) $class=substr($class,8);
	$classPath=$class.'.php';
	require_once($classPath);
}

/**
 * A shutdown function which executes before the script terminates.
 */
function nuggetsShutdown() {
	global $basePath,$logFile;
	$error=error_get_last();
	chdir($basePath);
	if($logFile) fclose($logFile);
	if(isset($GLOBALS['initialized'])) Config::save();
	if($error) call_user_func_array('nuggets\defaultErrorHandler',array_values($error));
}

?>

<?php
 namespace nuggets;
 
 /**
  * The error handler for framework related errors.
  */
 function nuggetsErrorHandler() {
	 if(!Engine::engineError()) return;
	 $errors=Engine::getErrors();
	 require_once('static/nuggetsError.php');
	 die();
 }
 
 /**
  * The default error handler for the framework.
  * 
  * @param int $level
  * @param string $message
  * @param string $filename
  * @param int $line
  */
 function defaultErrorHandler($level,$message,$filename,$line) {
	$msg=createErrorMessage(func_get_args());
	logEvent($message.' at '.$filename.' on line '.$line);
	require_once('static/errorDefault.php');
	die();
}

/**
 * Fetches the string representation of the error level.
 * 
 * @param int $value
 * @return string
 */
function fetchErrorLevel($value) {
	$errorLevels=array(1=>'FATAL',2=>'WARNING',4=>'PARSE',8=>'NOTICE');
	if($value<10) return $errorLevels[$value];
	else return 'INTERNAL';
}

/**
 * Creates an error message based on the error information.
 * 
 * @param string[] $args
 * @return string
 */
function createErrorMessage($args) {
	$level=fetchErrorLevel($args[0]);
	$message=$args[1];
	$file=$args[2];
	$line=$args[3];
	$error='<table align="center"><tr><th>'.$level.'</th><td>'.$message.' *(at file: '.$file.', line '.$line.')*</td></tr></table>';
	return $error;
}

?>
