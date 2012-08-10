<?php
import("nuggets.core.interface.AppInterface");

class ExternalDatabase extends AppInterface {
    
    private $host;
    private $port;
    private $username;
    private $password;
    private $dbname;
    
    public function inheritHost() {
        $this->host=Config::read("database", "host");
        $this->port=Config::read("database", "port");
    }
    
    public function inheritCredentials() {
        $this->username=Config::read("database", "username");
        $this->password=Config::read("database", "password");
    }
    
    public function setHost($host,$port) {
        $this->host=$host;
        $this->port=$port;
    }
    
    public function setCredentials($username,$password) {
        $this->username=$username;
        $this->password=$password;
    }
    
    public function setDatabase($database) {
        $this->dbname=$database;
    }
    
    public function fetch($query) {
        Database::disconnect();
        $con=@mysql_connect($this->host,$this->username,$this->password);
        if(!$con) {
            Engine::logError("database", 400);
            return NULL;
        }
        if(!@mysql_select_db($this->dbname,$con)) {
            Engine::logError("database", 401);
            return NULL;
        }
        $ptr=mysql_query($query,$con);
        $resultset=array();
        while($row=mysql_fetch_array($ptr)) array_push ($resultset, $row);
        mysql_close($con);
        Database::connect();
        return $resultset;
    }
}

?>
