<?php
/**
 * This file contains the Session class.
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
 * This class manages the sessions for the application.
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
class Session {
    
    private static $authorized=false;
    private static $running=false;
    private static $session_id=null;
    private static $timeout=1800;
    private static $user_key="session_user";
    private static $session_vars=array();
    private static $mandatory_vars=array();
    private static $control_keys=array('session_user','session_vars','mandatory_vars','expire_time');
	
	/**
	 * Initializes the session manager.
	 */
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
    
    /**
     * Tells whether a session is running or not.
     * 
     * @return boolean
     */
    public static function isRunning() {
        return self::$running;
    }
    
    /**
     * Starts a session.
     * 
     * @param string $id
     */
    public static function start($id) {
        self::$session_id=session_id();
        $_SESSION[self::$user_key]=$id;
        self::setTimeout(self::$timeout);
        self::$running=TRUE;
    }
    
    /**
     * Stops a running session.
     */
    public static function stop() {
        unset($_SESSION[self::$user_key]);
        self::$session_id=NULL;
        session_destroy();
        self::$running=FALSE;
    }
    
    /**
     * Fetches the user ID associated with a session.
     * 
     * @return string
     */
    public static function getUserID() {
        return $_SESSION[self::$user_key];
    }
    
    /**
     * Sets a variable for the current running session.
     * 
     * @param string $key
     * @param string $value
     * @param boolean $mandatory
     * @return boolean
     */
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
    
    /**
     * Fetches a variable associated with the running session.
     * 
     * @param string $key
     * @return string
     */
    public static function getVar($key) {
        return $_SESSION[$key];
    }
    
    /**
     * Fetches the previously set session ID for the current session.
     * 
     * @return string
     */
    public static function getSessionID() {
        return self::$session_id;
    }
    
    /**
     * Sets the timeout for the session.
     * 
     * @param int $minutes
     * @return boolean
     */
    public static function setTimeout($minutes) {
        if($minutes<5) return FALSE;
        $seconds=$minutes*60;
        $_SESSION['expire_time']=time()+$seconds;
        return TRUE;
    }
    
    /**
     * Tells whether the session has timed out or not.
     * 
     * @return boolean
     */
    public static function timedOut() {
        $expiry=$_SESSION['expire_time'];
        if(time()>$expiry) return TRUE;
        return FALSE;
    }
    
    /**
     * Sets the current session as authorized or unauthorized.
     * 
     * @param boolean $auth
     */
    public static function setAuthorized($auth) {
        self::$authorized=$auth;
    }
    
    /**
     * Tells whether the current session is authorized or not.
     * 
     * @return boolean
     */
    public static function isAuthorized() {
        return self::$authorized;
    }
}

?>
