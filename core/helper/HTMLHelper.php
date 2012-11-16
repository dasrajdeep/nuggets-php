<?php
/**
 * This file contains the HTMLHelper class.
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

require_once('core/Helper/Helper.php');

/**
 * This class provides helper features for HTML.
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
class HTMLHelper extends Helper {
    
    private static $inputs=array(
        "checkbox"=>"renderCheckBox",
        "radio"=>"renderRadio"
    );
	
	/**
	 * Generates a text field.
	 * 
	 * @param string $type
	 * @param string $name
	 * @param string $value
	 * @param string $class
	 * @return string
	 */
    public static function getInput($type,$name,$value='',$class='') {
        $html="";
        if(in_array($type, array_keys(self::$inputs))) {
            $handler=self::$inputs[$type];
            $html=self::$handler($name,$value,$class);
        }
        else $html=sprintf('<input type="%s" name="%s" class="%s" value="%s" />',$type,$name,$class,$value);
        return $html;
    }
    
    /**
     * Generates a check box.
     * 
     * @param string $name
     * @param string $value
     * @param string $class
     * @return string
     */
    public static function renderCheckBox($name,$value,$class) {
        return sprintf('<span>%s<input type="checkbox" name="%s" class="%s" /></span>',$value,$name,$class);
    }
    
    /**
     * Generates a radio button.
     * 
     * @param string $name
     * @param string $value
     * @param string $class
     * @param string $id
     * @return string
     */
    public static function renderRadio($name,$value,$class,$id='') {
        return sprintf('<span>%s<input type="radio" name="%s" id="%s" class="%s" /></span>',$value,$name,$id,$class);
    }
	
	/**
	 * Generates an image.
	 * 
	 * @param string $path
	 * @param int $width
	 * @param int $height
	 * @param string $id
	 * @return string
	 */
    public static function getImage($path,$width='',$height='',$id='') {
        $html=sprintf('<img width="%s" height="%s" src="%s%s" id="%s" />',$width,$height,Registry::getPath("view"),$path,$id);
        return $html;
    }
    
    /**
     * Generates a hyperlink.
     * 
     * @param string $text
     * @param string $url
     * @param string $id
     * @return string
     */
    public static function getLink($text,$url,$id) {
        $html=sprintf('<a href="%s" id="%s">%s</a>',$url,$id,$text);
        return $html;
    }
    
    /**
     * Generates a text area.
     * 
     * @param string $id
     * @return string
     */
    public static function getTextArea($id) {
        $html=sprintf('<textarea id="%s"></textarea>',$id);
        return $html;
    }
}

?>
