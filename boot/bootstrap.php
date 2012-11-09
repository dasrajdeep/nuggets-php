<?php

session_start();

require_once('boot/errorHandler.php');

require_once('core/Registry.php');
require_once('core/Engine.php');
require_once('core/Command.php');
require_once('core/Dispatcher.php');
require_once('core/Config.php');
require_once('core/Session.php');

Session::init();
Registry::init();
Config::init();

/**require_once('core/Database.php');
Database::connect();
register_shutdown_function('shutdown');
function shutdown() {
	Database::disconnect();
}*/

?>