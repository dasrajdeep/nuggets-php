<?php

class Engine {
    
    private static $version="2.0";

    private static $entities=array(
        "Admin"=>"core/Admin.php",
        "Command"=>"core/Config.php",
        "Config"=>"core/Config.php",
        "Dispatcher"=>"core/Dispatcher.php",
        "Engine"=>"core/Engine.php",
        "Session"=>"core/Session.php",
        "Router"=>"core/Router.php",
        "Database"=>"core/dbstore/Database.php",
        "JSON"=>"core/dbstore/JSON.php",
        "XML"=>"core/dbstore/XML.php",
        "Helper"=>"core/helper/Helper.php",
        "CSSHelper"=>"core/helper/CSSHelper.php",
        "HTMLHelper"=>"core/helper/HTMLHelper.php",
        "JSHelper"=>"core/helper/JSHelper.php",
        "Mailer"=>"core/mailer/Mailer.php",
        "Generator"=>"core/security/Generator.php",
        "HTMLView"=>"core/view/HTMLView.php",
        "JSONView"=>"core/view/JSONView.php",
        "XMLView"=>"core/view/XMLView.php",
        "View"=>"core/view/View.php",
        "Controller"=>"core/controller/Controller.php",
        "Model"=>"core/model/Model.php",
        "Upload"=>"core/upload/Upload.php",
        "PasswordAuthentication"=>"core/auth/PasswordAuthentication.php",
        "AJAXPoll"=>"core/ajaxpoll/AJAXPoll.php",
        "ExternalDatabase"=>"core/interface/ExternalDatabase.php"
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
}

?>
