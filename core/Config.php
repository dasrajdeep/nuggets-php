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
	
	/**
	 * Contains the global configuration settings.
	 * 
	 * @var mixed[]
	 */
    private static $config=null;
    
    /**
     * Contains the tracker information.
     * 
     * @var mixed[]
     */
    private static $tracker=null;
	
	/**
	 * Checks extensions and loads the configuration.
	 */
    public static function init() {
        self::checkSetup();
        self::loadConfig();
        self::loadTracker();
    }
    
    /**
     * Checks if required extensions are installed or not.
     */
    private static function checkSetup() {
        $ver=explode(".",phpversion());
        if($ver[0]<5) Engine::logError ("version", 300);
        if(!extension_loaded("libxml")) Engine::logError("extension", 200);
        if(!extension_loaded("mysql")) Engine::logError("extension", 202);
        if(!extension_loaded("session")) Engine::logError("extension", 203);
        
        $perm=substr(sprintf('%o',fileperms('.tracker')),-3);
        if($perm!='777') {
			if(!chmod('.tracker',0777)) Engine::logError('config', 101);
		}
    }
    
    /**
     * Loads the configuration from a file.
     */
	public static function loadConfig() {
		$config=parse_ini_file('nuggets.ini',true);
		self::$config=$config;
	}
	
	/**
	 * Loads the file modification tracker.
	 */
	public static function loadTracker() {
		$tracker=parse_ini_file('.tracker');
		self::$tracker=$tracker;
	}
	
	/**
	 * Reads a configuration setting.
	 * 
	 * @param string $key
	 * @param string $set
	 * @return string|null
	 */
    public static function read($key,$set='global') {
		if($set==='global') {
			$keys=array_keys(self::$config);
			foreach($keys as $k) if(array_key_exists($key,self::$config[$k])) return self::$config[$k][$key];
			return null;
		} else if($set==='tracker') {
			if(array_key_exists($key,self::$tracker)) return self::$tracker[$key];
			return null;
		}
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
    
    /**
     * Writes a configuration value.
     * 
     * @param string $key
     * @param string $value
     * @param string $set
     */
    public static function write($key,$value,$set='tracker') {
		if($set==='tracker') {
			self::$tracker[$key]=$value;
		} else if($set==='global') {
			$keys=array_keys(self::$config);
			foreach($keys as $k) if(array_key_exists($key,self::$config[$k])) self::$config[$k][$key]=$value;
		}
	}
	
	/**
	 * Saves configuration settings to file.
	 * 
	 * @param string $set
	 */
	public static function save($set='tracker') {
		if($set==='tracker') {
			$cfg=fopen('.tracker','w+');
			$output='';
			$keys=array_keys(self::$tracker);
			foreach($keys as $k) $output.=sprintf("%s=%s\n",$k,self::$tracker[$k]);
			fwrite($cfg,$output);
			fclose($cfg);
		} else if($set==='global') {
			$cfg=fopen('nuggets.ini','w+');
			$output='';
			$sections=array_keys(self::$config);
			foreach($sections as $s) {
				$output.=sprintf("\n[%s]\n",$s);
				$keys=array_keys(self::$config[$s]);
				foreach($keys as $k) $output.=sprintf("%s=%s\n",$k,self::$config[$s][$k]);
			}
			fwrite($cfg,$output);
			fclose($cfg);
		}
	}
}

?>
