<?php
/**
 * This file contains the PasswordAuthentication class.
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

require_once('core/Database.php');
require_once('core/Authentication/Authentication.php');

/**
 * This class provides password authentication features.
 * 
 * @package    nuggets\Authentication
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 1.0
 */
class PasswordAuthentication extends Authentication {
    
    /**
     * Contains the field name for the username.
     * 
     * @var string
     */
    private $field_user;
    
    /**
     * Contains the field name for the password.
     * 
     * @var string
     */
    private $field_pass;
	
	/**
	 * Initializes the authenticator with the required authentication information.
	 * 
	 * @param string $table
	 * @param mixed[] $auth_fields
	 * @param string $encryption 
	 */
    public function __construct($table,$auth_fields,$encryption) {
        $this->auth_table=$table;
        $this->auth_type="password";
        $this->encryption=$encryption;
        $this->field_id=$auth_fields['id'];
        $this->field_user=$auth_fields['user'];
        $this->field_pass=$auth_fields['pass'];
    }
    
    /**
     * Tries to authenticate with the given credentials.
     * 
     * @param string $id
     * @param string $pass
     * @return boolean
     */
    public function authenticate($id,$pass) {
        $set=Database::get($this->auth_table, "*", sprintf("%s='%s'",$this->field_user,$id));
        if($set==NULL) return FALSE;
        $set=$set[0];
        $match_pass=$set[$this->field_pass];
        if($match_pass==$pass) return TRUE;
        return FALSE;
    }
    
    /**
     * Retrieves the credentials from a XML string.
     * 
     * @param string $xml
     * @return mixed[]
     */
    public function retrieveCredentials($xml) {
        //decrypt xml first
        $credentials=array();
        $xml=simplexml_load_string($xml);
        foreach($xml->children() as $c) {
            $node=$c->getName();
            if($node=='username') $credentials['username']=$c;
            elseif($node=='password') $credentials['password']=$c;
        }
        return $credentials;
    }
    
    /**
     * Starts the authentication process.
     * 
     * @param string $xml
     * @return boolean
     */
    public function startAuth($xml) {
        $credentials=$this->retrieveCredentials($xml);
        $auth=$this->authenticate($credentials['username'], $credentials['password']);
        if($auth) {
            $this->setUserID($this->field_user, $credentials[username]);
            $this->authorize();
        }
        return $auth;
    }
}

?>
