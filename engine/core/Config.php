<?php

class Config {
    public static $default_config=array();
    public static $non_default=array();
    
    public static function loadAll() {
        Config::checkExtensions();
        Config::loadEngineConfig();
        Config::loadSiteConfig();
        Config::loadRoutes();
        Config::loadPaths();
    }
    
    public static function checkExtensions() {
        $ver=explode(".",phpversion());
        if($ver[0]<5) Engine::logError ("version", 300);
        if(!extension_loaded("libxml")) Engine::logError("extension", 200);
        if(!extension_loaded("mcrypt")) Engine::logError("extension", 201);
        if(!extension_loaded("mysql")) Engine::logError("extension", 202);
        if(!extension_loaded("session")) Engine::logError("extension", 203);
    }

    public static function loadPaths() {
        require_once Engine::path("config_app").'paths.php';
    }
    
    public static function loadRoutes() {
        require_once Engine::path("config_app").'routes.php';
    }
    
    public static function loadSiteConfig() {
        $file=file_exists(Engine::path("config_site"));
        if(!$file) {
            Engine::logError("config", 101);
            return;
        }
        $xml=simplexml_load_file(Engine::path("config_site"));
        foreach($xml->children() as $node) {
            self::$default_config[$node->getName()]=array();
            foreach($node->children() as $n) self::$default_config[$node->getName()][$n->getName()]=$n;
        }
        if(self::$default_config["site"]["title"]=="") self::$default_config["site"]["title"]="Nuggets";
    }
    
    public static function loadEngineConfig() {
        $file=file_exists(Engine::path("config_engine"));
        if(!$file) {
            Engine::logError("config", 100);
            return;
        }
        $xml=simplexml_load_file(Engine::path("config_engine"));
        foreach($xml->children() as $node) {
            self::$default_config[$node->getName()]=array();
            foreach($node->children() as $n) self::$default_config[$node->getName()][$n->getName()]=$n;
        }
    }

    public static function write($entity,$key,$value) {
        self::$non_default[$entity][$key]=$value;
    }

    public static function read($entity,$key) {
        $value=self::$default_config[$entity][$key];
        if($value==NULL) $value=self::$non_default[$entity][$key];
        return $value;
    }
    
    public static function readKeys($entity) {
        return array_keys(self::$default_config[$entity]);
    }
    
    public static function getDataSet($entity) {
        return self::$default_config[$entity];
    }
}

?>
