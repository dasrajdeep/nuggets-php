<?php
Engine::uses("Config");

class Engine {
    
    private static $version="1.1";

    private static $paths=array(
        "webroot"=>"webroot/",
        "config_app"=>"engine/config/",
        "config_engine"=>"data/config_engine.xml",
        "config_site"=>"data/config_site.xml",
        "view"=>"engine/view/",
        "jquery"=>"vendor/jquery.js",
        "jqueryui"=>"vendor/jquery-ui/",
        "base64"=>"vendor/base64.js",
        "uploader"=>"vendor/valums/",
        "scriptlib"=>"engine/view/scriptlib/"
    );

    private static $entities=array(
        "Admin"=>"engine/core/Admin.php",
        "Command"=>"engine/core/Config.php",
        "Config"=>"engine/core/Config.php",
        "Dispatcher"=>"engine/core/Dispatcher.php",
        "Engine"=>"engine/core/Engine.php",
        "Router"=>"engine/core/Router.php",
        "Database"=>"engine/core/dbstore/Database.php",
        "JSON"=>"engine/core/dbstore/JSON.php",
        "XML"=>"engine/core/dbstore/XML.php",
        "Helper"=>"engine/core/helper/Helper.php",
        "CSSHelper"=>"engine/core/helper/CSSHelper.php",
        "HTMLHelper"=>"engine/core/helper/HTMLHelper.php",
        "JSHelper"=>"engine/core/helper/JSHelper.php",
        "Mailer"=>"engine/core/mailer/Mailer.php",
        "Generator"=>"engine/core/security/Generator.php",
        "HTMLView"=>"engine/core/view/HTMLView.php",
        "JSONView"=>"engine/core/view/JSONView.php",
        "XMLView"=>"engine/core/view/XMLView.php",
        "View"=>"engine/core/view/View.php",
        "Controller"=>"engine/core/controller/Controller.php",
        "Model"=>"engine/core/model/Model.php",
        "Upload"=>"engine/core/upload/Upload.php"
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

    public static function init(){
        Router::init();
        Config::loadAll();
        Database::connect();
        register_shutdown_function(array('Engine','shutdown'));
    }

    public static function addPath($entity,$path) {
        self::$paths[$entity]=$path;
    }
    
    public static function path($file) {
        return self::$paths[$file];
    }
    
    public static function helper($helper_name) {
        $entity=self::$view_helpers[$helper_name];
        self::uses($entity);
    }
    
    public static function uses($entity) {
        $entity_path=self::$entities[$entity];
        require_once $entity_path;
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
        if($_SERVER['SERVER_PORT']!='80') $port=$_SERVER['SERVER_PORT'];
        $uri="http://".$_SERVER["SERVER_NAME"].":".$port.$uri;
        return $uri;
    }
    
    public static function getVersion() {
        return self::$version;
    }

    public static function shutdown() {
        Database::disconnect();
    }
}

?>
