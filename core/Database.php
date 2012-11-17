<?php
/**
 * This file contains the Database class.
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
 * This class provides an interface to the database.
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
class Database {
	
	/**
	 * Contains the database connection object.
	 * 
	 * @var object
	 */
    private static $con=NULL;
    
    /**
     * Connects to the database.
     * 
     * @return boolean
     */
    public static function connect() {
        self::$con=mysql_connect(Config::read("db_host"),Config::read("db_username"),Config::read("db_password"));
        if(!self::$con) {
            Engine::logError("database", 400);
            return FALSE;
        }
        $selected=mysql_select_db(Config::read("db_name"),self::$con);
        if(!$selected) {
            Engine::logError("database", 401);
            return FALSE;
        }
        return TRUE;
    }
    
    /**
     * Disconnects from the database.
     */
    public static function disconnect() {
        mysql_close(self::$con);
    }
    
    /**
     * Fetches data from the database in the form of associative arrays.
     * 
     * @param string $table
     * @param string $values
     * @param string $criterion
     * @return mixed[][]
     */
    public static function get($table,$values,$criterion) {
		$con=self::$con;
        if(!$con) self::connect();
        $table=Config::read("db_prefix").$table;
        if($criterion!=FALSE) $criterion=" WHERE ".$criterion;
        else $criterion="";
        $query=sprintf("SELECT %s FROM %s%s",$values,$table,$criterion);
        $result=mysql_query($query,self::$con);
        if(!$result) return NULL;
        $rows=array();
        while($row=mysql_fetch_assoc($result)) array_push($rows, $row); 
        if(!$con) self::disconnect();
        return $rows;
    }
    
    /**
     * Inserts data into the database.
     * 
     * @param string $table
     * @param string[] $fields
     * @param string[] $data
     * @return boolean
     */
    public static function add($table,$fields,$data) {
        $con=self::$con;
        if(!$con) self::connect();
        $table=Config::read("db_prefix").$table;
        $fields=implode(",", $fields);
        for($i=0;$i<count($data);$i++) $data[$i]=sprintf("'%s'",$data[$i]);
        $data=implode(",", $data);
        $query=sprintf("INSERT INTO %s (%s) VALUES (%s)",$table,$fields,$data);
        $result=mysql_query($query,self::$con);
        if(!$con) self::disconnect();
        return $result;
    }
    
    /**
     * Updates data in the database.
     * 
     * @param string $table
     * @param string[] $fields
     * @param string[] $data
     * @param string $criterion
     * @return boolean
     */
    public static function update($table,$fields,$data,$criterion) {
        $con=self::$con;
        if(!$con) self::connect();
        $table=Config::read("db_prefix").$table;
        $assignments=array();
        for($i=0;$i<count($fields);$i++) array_push($assignments, sprintf("%s='%s'",$fields[$i],$data[$i]));
        $set=implode(",", $assignments);
        $query=sprintf("UPDATE %s SET %s WHERE %s",$table,$set,$criterion);
        $result=mysql_query($query,self::$con);
        if(!$con) self::disconnect();
        return $result;
    }
    
    /**
     * Deletes data from the database.
     * 
     * @param string $table
     * @param string $match
     * @return boolean
     */
    public static function remove($table,$match) {
        $con=self::$con;
        if(!$con) self::connect();
        $table=Config::read("db_prefix").$table;
        $query=sprintf("DELETE FROM %s WHERE %s",$table,$match);
        $result=mysql_query($query,self::$con);
        if(!$con) self::disconnect();
        return $result;
    }
    
    /**
     * Executes an arbitrary query on the database.
     * 
     * @param string $query
     * @return boolean|resource
     */
    public static function execute_query($query) {
        $con=self::$con;
        if(!$con) self::connect();
        $result=mysql_query($query,self::$con);
        if(preg_match('/^(select|SELECT|show|SHOW|describe|DESCRIBE|desc|DESC|explain|EXPLAIN)[ ]/',$query)===1) {
			$tmp=array();
			while($r=mysql_fetch_assoc($result)) array_push($tmp,$r);
			$result=$tmp;
		}
		if(!$con) self::disconnect();
        return $result;
    }
}
?>
