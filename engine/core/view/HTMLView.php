<?php

class HTMLView extends View {
    
    //store the theme layouts
    private $theme_styles=array();
    private $theme_scripts=array();
    //store specific layouts
    private $styles=array();
    private $scripts=array();
    
    function __construct() {
        $this->addPath("template", "engine/view/themes/template/template.php");
        $this->addPath("theme", "engine/view/themes/");
        $this->addPath("theme_styles", "engine/view/themes/styles/");
        $this->addPath("theme_scripts", "engine/view/themes/scripts/");
        $this->addPath("theme_images", "engine/view/themes/images/");
        $this->addPath("default_style", "engine/view/Default/style.php");
        $this->addPath("default_script", "engine/view/Default/script.php");
    }

    public function renderView($view) {
        $cfg=$this->loadViewCfg();
        $cfg_array=$this->readCfg($cfg);
        $cfg_view=NULL;
        foreach($cfg_array as $c) {
            if($c["name"]==$view) $cfg_view=$c;
        }
        $this->processView($cfg_view);
    }
    
    private function processView($cfg_array) {
        $this->scripts=$cfg_array["scripts"];
        $this->styles=$cfg_array["styles"];
        $file=$cfg_array["file"];
        if($this->getLayoutName()=="theme" || $this->getLayoutName()=="both") $this->loadTheme();
        if($cfg_array["category"]=="page") require_once $this->getPath("template");
        else {
            $this->loadHeaders();
            require_once $this->getViewPath().$file;
        }
    }
    
    private function loadHeaders() {
        if($this->getLayoutName()=="theme" || $this->getLayoutName()=="both") {
            foreach($this->theme_styles as $s) require_once $this->getPath("theme_styles").$s;
            foreach($this->theme_scripts as $s) require_once $this->getPath("theme_scripts").$s;
        }
        if($this->getLayoutName()=="specific" || $this->getLayoutName()=="both") {
            foreach($this->styles as $s) require_once $this->getViewPath().$s;
            foreach($this->scripts as $s) require_once $this->getViewPath().$s;
        }
        if($this->getLayoutName()=="default") {
            require_once $this->getPath("default_style");
            require_once $this->getPath("default_script");
            foreach($this->scripts as $s) require_once $this->getViewPath().$s;
        }
    }
    
    private function loadTheme() {
        $xml=simplexml_load_file($this->getPath("theme")."themecfg.xml");
        foreach($xml->children() as $child) {
            if($child->getName()=="scripts") {
                foreach($child->children() as $c) array_push($this->theme_scripts, $c);
            }
            else if($child->getName()=="styles") {
                foreach($child->children() as $c) array_push($this->theme_styles,$c);
            }
        }
    }
    
    private function readCfg($cfg) {
        $viewcfg=array();
        $count=0;
        foreach($cfg->children() as $child) {
            if($child->getName()!="view") return NULL;
            foreach ($child->children() as $c) {
                if($c->getName()=="type" && $c!="html") return NULL;
                else if($c->getName()=="name") $viewcfg[$count]["name"]=$c;
                else if($c->getName()=="category") $viewcfg[$count]["category"]=$c;
                else if($c->getName()=="file") $viewcfg[$count]["file"]=$c;
                else {
                    $cnt=0;
                    $viewcfg[$count][$c->getName()]=array();
                    foreach($c->children() as $n) $viewcfg[$count][$c->getName()][$cnt++]=$n;
                }
            }
            $count++;
        }
        return $viewcfg;
    }
}

?>
