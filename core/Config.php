<?php
/**
 * This file contains the Config class.
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
 * This class manages the configurations of the framework.
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
class Config {

    private static $config=null;
	
	/**
	 * Checks extensions and loads the configuration.
	 */
    public static function init() {
        self::checkExtensions();
        self::loadConfig();
    }
    
    /**
     * Checks if required extensions are installed or not.
     */
    private static function checkExtensions() {
        $ver=explode(".",phpversion());
        if($ver[0]<5) Engine::logError ("version", 300);
        if(!extension_loaded("libxml")) Engine::logError("extension", 200);
        if(!extension_loaded("mcrypt")) Engine::logError("extension", 201);
        if(!extension_loaded("mysql")) Engine::logError("extension", 202);
        if(!extension_loaded("session")) Engine::logError("extension", 203);
    }
    
    /**
     * Loads the configuration from a file.
     */
	public static function loadConfig() {
		$config=parse_ini_file('nuggets.ini',true);
		self::$config=$config;
	}
	
	/**
	 * Reads a configuration setting.
	 * 
	 * @param string $key
	 * @return string|null
	 */
    public static function read($key) {
        $keys=array_keys(self::$config);
		foreach($keys as $k) if(array_key_exists($key,self::$config[$k])) return self::$config[$k][$key];
		return null;
    }
    
    /**
     * Reads all the configuration attributes of a particular entity.
     * 
     * @param string
     * @return string[]|null
     */
    public static function readAttributes($entity) {
        if(array_key_exists($entity,self::$config)) return array_keys(self::$config[$entity]);
		else return null;
    }
    
}

?>
