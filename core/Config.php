<?php

class Config {

    private static $config=null;

    public static function init() {
        self::checkExtensions();
        self::loadConfig();
    }
    
    private static function checkExtensions() {
        $ver=explode(".",phpversion());
        if($ver[0]<5) Engine::logError ("version", 300);
        if(!extension_loaded("libxml")) Engine::logError("extension", 200);
        if(!extension_loaded("mcrypt")) Engine::logError("extension", 201);
        if(!extension_loaded("mysql")) Engine::logError("extension", 202);
        if(!extension_loaded("session")) Engine::logError("extension", 203);
    }
    
	public static function loadConfig() {
		$config=parse_ini_file('nuggets.ini',true);
		self::$config=$config;
	}

    public static function read($key) {
        $keys=array_keys(self::$config);
		foreach($keys as $k) if(array_key_exists($key,self::$config[$k])) return self::$config[$k][$key];
		return null;
    }
    
    public static function readAttributes($entity) {
        if(array_key_exists($entity,self::$config)) return array_keys(self::$config[$entity]);
		else return null;
    }
    
}

?>
