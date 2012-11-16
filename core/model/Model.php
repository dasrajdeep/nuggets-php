<?php
/**
 * This file contains the Model class.
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
 * This class represents a general model.
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
class Model {
    
    //name of entity
    public $name="";
    //data fetched or generated from model
    public $data=array();
    //core modules used by this model
    public $coreModules=array();
	
	/**
	 * Initializes the model.
	 */
    public function init() {
        foreach($this->coreModules as $c) Engine::uses($c);
    }
    
    /**
     * Fetches the name of the entity associated with this model.
     * 
     * @return string
     */
    public function getEntityName() {
        return $this->name;
    }
}

?>
