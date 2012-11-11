<?php

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
        100=>"engine configuration file not found",
        101=>"site configuration file not found",
        200=>"libxml extension not loaded",
        201=>"mcrypt extension not loaded",
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
    
    public static function addIncludePath($path) {
        $newpath=get_include_path().PATH_SEPARATOR.$path;
        set_include_path($newpath);
    }
    
    public static function helper($helper_name) {
        $class=self::$view_helpers[$helper_name];
        self::uses($class);
    }
    
    public static function uses($class) {
        $classpath=self::$moduleClass[$class];
        require_once $classpath;
    }
    
    public static function logError($entity,$error) {
        array_push(self::$error_log[$entity],$error);
        self::$errorLogged=TRUE;
    }
    
    public static function getErrors() {
        $keys=array_keys(self::$error_log);
        $errorset=array();
        foreach($keys as $k) {
            $entity=self::$error_log[$k];
            if(count($entity)!=0) {
                foreach($entity as $e) array_push($errorset,$e);
            }
        }
        return $errorset;
    }

    public static function engineError() {
        return self::$errorLogged;
    }
    
    public static function getError($errno) {
        return self::$errors[$errno];
    }
    
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
    
    public static function getVersion() {
        return self::$version;
    }
}

?>
