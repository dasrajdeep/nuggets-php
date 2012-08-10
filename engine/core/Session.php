<?php

class Session {
    
    private static $authorized=false;
    private static $running=false;
    private static $session_id=null;
    private static $timeout=1800;
    private static $user_key="session_user";
    private static $session_vars=array();
    private static $mandatory_vars=array();
    private static $control_keys=array('session_user','session_vars','mandatory_vars','expire_time');

    public static function init() {
        if(isset($_SESSION[self::$user_key])) {
            if(self::timedOut()) {
                self::stop();
                return;
            }
            self::$running=TRUE;
            self::$session_id=session_id();
            self::$session_vars=$_SESSION['session_vars'];
            self::$mandatory_vars=$_SESSION['mandatory_vars'];
        }
        else {
            $_SESSION['session_vars']=array();
            $_SESSION['mandatory_vars']=array();
        }
    }
    
    public static function isRunning() {
        return self::$running;
    }
    
    public static function start($id) {
        self::$session_id=session_id();
        $_SESSION[self::$user_key]=$id;
        self::setTimeout(self::$timeout);
        self::$running=TRUE;
    }
    
    public static function stop() {
        unset($_SESSION[self::$user_key]);
        self::$session_id=NULL;
        session_destroy();
        self::$running=FALSE;
    }
    
    public static function getUserID() {
        return $_SESSION[self::$user_key];
    }
    
    public static function setVar($key,$value,$mandatory) {
        if(in_array($key,self::$control_keys)) return FALSE;
        self::$session_vars[$key]=$value;
        $_SESSION[$key]=$value;
        array_push($_SESSION['session_vars'],$key);
        if($mandatory) {
            array_push($_SESSION['mandatory_vars'],$key);
            array_push(self::$compulsory_vars, $key);
        }
        return TRUE;
    }
    
    public static function getVar($key) {
        return $_SESSION[$key];
    }
    
    public static function getSessionID() {
        return self::$session_id;
    }
    
    public static function setTimeout($minutes) {
        if($minutes<5) return FALSE;
        $seconds=$minutes*60;
        $_SESSION['expire_time']=time()+$seconds;
        return TRUE;
    }
    
    public static function timedOut() {
        $expiry=$_SESSION['expire_time'];
        if(time()>$expiry) return TRUE;
        return FALSE;
    }
    
    public static function setAuthorized($auth) {
        self::$authorized=$auth;
    }
    
    public static function isAuthorized() {
        return self::$authorized;
    }
}

?>
