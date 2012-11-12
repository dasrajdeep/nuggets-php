<?php

namespace nuggets;

class Database {
    private static $con=FALSE;
    
    public static function connect() {
        self::$con=@mysql_connect(Config::read("db_host"),Config::read("db_username"),Config::read("db_password"));
        if(!self::$con) {
            Engine::logError("database", 400);
            return FALSE;
        }
        $selected=@mysql_select_db(Config::read("db_name"),self::$con);
        if(!$selected) {
            Engine::logError("database", 401);
            return FALSE;
        }
        return TRUE;
    }
    
    public static function disconnect() {
        @mysql_close(self::$con);
    }
    
    //Operations on database.
    public static function get($table,$values,$criterion) {
        if(!self::$con) return NULL;
        $table=Config::read("db_prefix").$table;
        if($criterion!=FALSE) $criterion=" WHERE ".$criterion;
        else $criterion="";
        $query=sprintf("SELECT %s FROM %s%s",$values,$table,$criterion);
        $result=mysql_query($query,self::$con);
        if(!$result) return NULL;
        $rows=array();
        while($row=mysql_fetch_assoc($result)) array_push($rows, $row); 
        return $rows;
    }
    
    public static function add($table,$fields,$data) {
        if(!self::$con) return FALSE;
        $table=Config::read("db_prefix").$table;
        $fields=implode(",", $fields);
        for($i=0;$i<count($data);$i++) $data[$i]=sprintf("'%s'",$data[$i]);
        $data=implode(",", $data);
        $query=sprintf("INSERT INTO %s (%s) VALUES (%s)",$table,$fields,$data);
        $result=mysql_query($query,self::$con);
        if(!$result) return FALSE;
        return TRUE;
    }
    
    public static function update($table,$fields,$data,$criterion) {
        if(!self::$con) return FALSE;
        $table=Config::read("db_prefix").$table;
        $assignments=array();
        for($i=0;$i<count($fields);$i++) array_push($assignments, sprintf("%s='%s'",$fields[$i],$data[$i]));
        $set=implode(",", $assignments);
        $query=sprintf("UPDATE %s SET %s WHERE %s",$table,$set,$criterion);
        $result=mysql_query($query,self::$con);
        if(!$result) return FALSE;
        return true;
    }
    
    public static function remove($table,$match) {
        if(!self::$con) return false;
        $table=Config::read("db_prefix").$table;
        $query=sprintf("DELETE FROM %s WHERE %s",$table,$match);
        $result=mysql_query($query,self::$con);
        if(!$result) return FALSE;
        return true;
    }
    
    public static function execute_query($query) {
        if(!self::$con) return false;
        $result=mysql_query($query,self::$con);
        if(!$result) return false;
        else return $result;
    }
}
?>