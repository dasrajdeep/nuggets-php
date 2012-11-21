<?php
/**
 * This file contains the Extension class.
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
 * This class manages the extensions to the application.
 * 
 * @package    nuggets
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 3.6
 */
class Extension {
	
	private static $extensions=array();
	
	private static $extConfig=null;
	
	static function init() {
		$extcfg=parse_ini_file('app/extensions.ini',true);
		self::$extConfig=$extcfg;
		
		$extNames=array_keys($extcfg);
		
		foreach($extNames as $e) {
			$ext=$extcfg[$e];
			if($ext['status']!=='enabled') continue;
			self::$extensions[$e]=array();
			self::$extensions[$e]['directory']=$ext['directory'];
			chdir(Registry::getPath('extensions').$ext['directory']);
			$mainClass=$ext['mainclass'];
			require_once($mainClass.'.php');
			$mainClass='\\'.$ext['namespace'].'\\'.$mainClass;
			self::$extensions[$e]['instance']=new $mainClass();
			if(isset($ext['mainmethod'])) self::$extensions[$e]['main']=$ext['mainmethod'];
			chdir(Registry::getBasePath());
		}
	}
	
	static function getExtensions() {
		return array_keys(self::$extConfig);
	}
	
	static function getInstance($extension) {
		if(isset(self::$extensions[$extension])) return self::$extensions[$extension]['instance'];
		return null;
	}
	
	static function execMain($ext) {
		if(!isset(self::$extensions[$ext]) || !isset(self::$extensions[$ext]['main'])) return null;
		
		$instance=self::$extensions[$ext]['instance'];
		$main=self::$extensions[$ext]['main'];
		$args=func_get_args();
		$args=array_slice($args,1);
		
		chdir(self::$extensions[$ext]['directory']);
		
		$result=call_user_func_array(array($instance,$main),$args);
		
		chdir(Registry::getBasePath());
		set_error_handler('nuggets\defaultErrorHandler');
		
		return $result;
	}
	
}

?>
