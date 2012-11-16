<?php
/**
 * This file contains the Engine class.
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
 * This class manages utility requirements of the framework.
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
class Engine {
    
    private static $version="3.0";
	
	private static $modules=array(
		'Authentication',
		'Controller',
		'Helper',
		'Mailer',
		'Model',
		'View'
	);
	
    private static $moduleClass=array(
		'Database'=>'core/Database.php',
		'Session'=>'core/Session.php',
		'HTMLHelper'=>'core/Helper/HTMLHelper.php',
		'CSSHelper'=>'core/Helper/CSSHelper.php',
		'HTMLView'=>'core/View/HTMLView.php'
	);
    
    private static $view_helpers=array(
        "html"=>"HTMLHelper",
        "css"=>"CSSHelper",
        "js"=>"JSHelper"
    );
    
    private static $errors=array(
        100=>"configuration file not found",
        101=>"not enough file permissions",
        200=>"libxml extension not loaded",
        202=>"mysql extension not loaded",
        203=>"session extension not loaded",
        300=>"php version is lower than 5",
        400=>"unable to connect to database",
        401=>"database does not exist"
    );

    private static $error_log=array(
        "database"=>array(),
        "config"=>array(),
        "extension"=>array(),
        "version"=>array()
    );
    
    private static $errorLogged=FALSE;
    
    /**
     * Adds an include path to the PHP engine.
     * 
     * @param string $path
     */
    public static function addIncludePath($path) {
        $newpath=get_include_path().PATH_SEPARATOR.$path;
        set_include_path($newpath);
    }
    
    /**
     * Loads a helper class.
     * 
     * @param string $helper_name
     */
    public static function helper($helper_name) {
        $class=self::$view_helpers[$helper_name];
        self::uses($class);
    }
    
    /**
     * Loads a module class.
     * 
     * @param string $class
     */
    public static function uses($class) {
        $classpath=self::$moduleClass[$class];
        require_once $classpath;
    }
    
    /**
     * Logs an error.
     * 
     * @param string $entity
     * @param string $error
     */
    public static function logError($entity,$error) {
		if(!array_key_exists($error,self::$errors)) return;
        array_push(self::$error_log[$entity],$error);
        self::$errorLogged=TRUE;
    }
    
    /**
     * Fetches the logged errors.
     * 
     * @return mixed[]
     */
    public static function getErrors() {
        $keys=array_keys(self::$error_log);
        $errorset=array();
        foreach($keys as $k) {
            $entity=self::$error_log[$k];
            if(count($entity)!=0) {
                foreach($entity as $e) array_push($errorset,array($e,self::$errors[$e]));
            }
        }
        return $errorset;
    }
	
	/**
	 * Tells whether an error occured.
	 * 
	 * @return boolean
	 */
    public static function engineError() {
        return self::$errorLogged;
    }
    
    /**
     * Fetches the message associated with an error number.
     * 
     * @return string
     */
    public static function getError($errno) {
        return self::$errors[$errno];
    }
    
    /**
     * Fetches the URL of the document root for the application.
     * 
     * @return string
     */
    public static function getHostURL() {
        $req=explode("/",$_SERVER["REQUEST_URI"]);
        $scr=explode("/",$_SERVER["SCRIPT_NAME"]);
        $uri=array();
        for($i=0;$i<count($scr);$i++) {
            if($req[$i]!=$scr[$i]) break;
            array_push($uri,$req[$i]);
        }
        $uri=implode("/", $uri)."/";
        $port="";
        if($_SERVER['SERVER_PORT']!='80') $port=":".$_SERVER['SERVER_PORT'];
        $uri="http://".$_SERVER["SERVER_NAME"].$port.$uri;
        return $uri;
    }
    
    /**
     * Fetches the version of the engine.
     * 
     * @return string
     */
    public static function getVersion() {
        return self::$version;
    }
}

?>
