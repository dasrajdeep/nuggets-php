<?php
/**
 * This file contains the Registry class.
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

/**
 * This class maintains the registry for the application framework.
 * 
 * @package    nuggets
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 1.0
 */
class Registry {
	
	/**
	 * Contains the internal commands associated with the framework.
	 * 
	 * @var string[]
	 */
	private static $engine_routes=array('master');
	
	/**
	 * Contains the routes for the commands.
	 * 
	 * @var mixed[]
	 */
	private static $routes=array(
		'default'=>array('Default','loadDefaultView'),
		'master'=>array('Default','loadDefaultView')
	);
	
	/**
	 * Contains paths to resources.
	 * 
	 * @var mixed[]
	 */
	private static $paths=array(
		'datastore'=>'datastore/',
		'view'=>'app/view/',
		'jqueryui'=>'vendor/jquery-ui/',
		'scriptlib'=>'core/view/scriptlib/'
	);
	
	/**
	 * Loads configurations and initializes the registry.
	 */
	public static function init() {
		$config=parse_ini_file('app/app.ini',true);
		
		array_push(self::$engine_routes,Config::read('admin_location'));
		self::$routes[Config::read('admin_location')]=array('Admin','showAdminPage');
		
		$route_keys=array_keys($config['ROUTES']);
		$path_keys=array_keys($config['PATHS']);
		
		foreach($route_keys as $k) {
			if(in_array($k,self::$engine_routes)) continue;
			$set=explode(':',$config['ROUTES'][$k]);
			self::$routes[$k]=array($set[0],$set[1]);
		}
		
		foreach($path_keys as $k) self::$paths[$k]=$config['PATHS'][$k];
	}
	
	/**
	 * Tells whether a command is an internal command or not.
	 * 
	 * @param string $command
	 * @return boolean
	 */
	public static function isEngineCommand($command) {
		return in_array($command, self::$engine_routes);
	}
	
	/**
	 * Fetches the path associated with a resource.
	 * 
	 * @param string $resource
	 * @return string|null
	 */
	public static function getPath($resource) {
		if(array_key_exists($resource,self::$paths)) return self::$paths[$resource];
		else return null;
	}
	
	/**
	 * Fetches the route associated with a command.
	 * 
	 * @param string $command
	 * @return string[]|null
	 */
	public static function getRoute($command) {
		if(array_key_exists($command,self::$routes)) return self::$routes[$command];
		else return null;
	}
}

?>
