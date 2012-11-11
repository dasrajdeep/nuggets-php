<?php
require_once('core/Helper/Helper.php');

class HTMLHelper extends Helper {
    
    private static $inputs=array(
        "checkbox"=>"renderCheckBox",
        "radio"=>"renderRadio"
    );

    public static function getInput($type,$name,$value='',$class='') {
        $html="";
        if(in_array($type, array_keys(self::$inputs))) {
            $handler=self::$inputs[$type];
            $html=self::$handler($name,$value,$class);
        }
        else $html=sprintf('<input type="%s" name="%s" class="%s" value="%s" />',$type,$name,$class,$value);
        return $html;
    }
    
    public static function renderCheckBox($name,$value,$class) {
        return sprintf('<span>%s<input type="checkbox" name="%s" class="%s" /></span>',$value,$name,$class);
    }
    
    public static function renderRadio($name,$value,$class,$id='') {
        return sprintf('<span>%s<input type="radio" name="%s" id="%s" class="%s" /></span>',$value,$name,$id,$class);
    }

    public static function getImage($path,$width='',$height='',$id='') {
        $html=sprintf('<img width="%s" height="%s" src="%s%s" id="%s" />',$width,$height,Registry::getPath("view"),$path,$id);
        return $html;
    }

    public static function getLoader($path,$type,$id){
        $html=sprintf('<div class="loader" id="%s"><img src="%s%sloader-%s.gif" /></div>',$id,Registry::getPath("view"),$path,$type);
        return $html;
    }
    
    public static function getLink($text,$url,$id) {
        $html=sprintf('<a href="%s" id="%s">%s</a>',$url,$id,$text);
        return $html;
    }
    
    public static function getTextArea($id) {
        $html=sprintf('<textarea id="%s"></textarea>',$id);
        return $html;
    }
}

?>
