<?php

    function import($class) {
        $path="";
        $tokens=explode(".", $class);
        if(count($tokens)<3) return FALSE;
        
        if($tokens[0]=="nuggets") $path.="engine/";
        else return FALSE;
        
        $part=$tokens[1];
        if($part=="core") $path.="core/";
        else if($part=="model") $path.="model/";
        else if($part=="view") $path.="view/";
        else if($part=="controller") $path.="controller/";
        else return FALSE;
        
        if(count($tokens)==3) {
            $path.=$tokens[2].".php";
            require_once $path;
            return TRUE;
        }
        
        for($i=2;$i<count($tokens)-1;$i++) $path.=$tokens[$i]."/";
        $path.=$tokens[count($tokens)-1].".php";
        require_once $path;
        return TRUE;
    }
?>
