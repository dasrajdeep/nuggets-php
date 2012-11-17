<?php
/**
 * This file contains the Authentication class.
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
 * This class provides the general authentication features.
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
class Authentication {
    
    /**
     * Contains the table name for authentication.
     * 
     * @var string
     */
    protected $auth_table;
    
    /**
     * Contains the field name for the user ID.
     * 
     * @var string
     */
    protected $field_id;
    
    /**
     * Contains the type of authentication process.
     * 
     * @var string
     */
    protected $auth_type;
    
    /**
     * Contains the user ID.
     * 
     * @var string
     */
    protected $user_id=null;
	
	/**
	 * Sets the user ID for this authentication object.
	 * 
	 * @param string $auth_field
	 * @param string $auth_id
	 */
    public function setUserID($auth_field,$auth_id) {
        $set=Database::get($this->auth_table, $this->field_id,sprintf("%s='%s'",$auth_field,$auth_id));
        if($set==NULL) return NULL;
        $set=$set[0];
        $this->user_id=$set[$this->field_id];
    }
    
    /**
     * Authorizes the session for the user ID set previously.
     */
    protected function authorize() {
        Session::start($this->user_id);
        Session::setAuthorized(TRUE);
    }
}

?>
