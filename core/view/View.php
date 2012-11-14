<?php
/**
 * This file contains the View class.
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
 * This class represents a general view.
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
class View {
    
    //name of entity
    public $name;
    //variables for view
    public $viewVars=array();
    //path to view
    public $viewPath=null;
    //name of view
    public $viewName;
    //name of layout
    public $layout;
    //whether view uses a template or not
    public $usesTemplate=false;
    //extension name
    public $ext;
    //paths for layout
    public $paths=array();
    
    /**
     * Fetches the name of the entity associated with this controller.
     * 
     * @return string
     */
    public function getEntityName() {
        return $this->name;
    }
    
    /**
     * Fetches a variable set by the controller.
     * 
     * @param string $key
     * @return mixed
     */
    public function getVar($key) {
        return $this->viewVars[$key];
    }
    
    /**
     * Fetches the path associated with this view.
     * 
     * @return string
     */
    public function getViewPath() {
        return $this->viewPath;
    }
    
    /**
     * Fetches the name of this view.
     * 
     * @return string
     */
    public function getViewName() {
        return $this->viewName;
    }
    
    /**
     * Fetches the type of layout associated with this view.
     * 
     * @return string
     */
    public function getLayoutName() {
        return $this->layout;
    }
    
    /**
     * Fetches the extension of view files.
     * 
     * @return string
     */
    public function getExtension() {
        return $this->ext;
    }
    
    /**
     * Adds a path to this view.
     * 
     * @param string $name
     * @param string $path
     */
    public function addPath($name,$path) {
        $this->paths[$name]=$path;
    }
    
    /**
     * Fetches a path defined for this view.
     * 
     * @param string $name
     * @return string
     */
    public function getPath($name) {
        return $this->paths[$name];
    }
}

?>
