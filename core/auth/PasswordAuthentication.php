<?php

require_once('core/auth/Authentication.php');

class PasswordAuthentication extends Authentication {
    
    private $field_user;
    private $field_pass;

    public function __construct($table,$auth_fields,$encryption) {
        $this->auth_table=$table;
        $this->auth_type="password";
        $this->encryption=$encryption;
        $this->field_id=$auth_fields['id'];
        $this->field_user=$auth_fields['user'];
        $this->field_pass=$auth_fields['pass'];
    }
    
    public function authenticate($id,$pass) {
        $set=Database::get($this->auth_table, "*", sprintf("%s='%s'",$this->field_user,$id));
        if($set==NULL) return FALSE;
        $set=$set[0];
        $match_pass=$set[$this->field_pass];
        if($match_pass==$pass) return TRUE;
        return FALSE;
    }
    
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
