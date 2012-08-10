<?php

class HTMLView extends View {
    
    //store the theme layouts
<<<<<<< HEAD
    private $theme_styles=array();
    private $theme_scripts=array();
=======
    private $theme=array(
        "template"=>"",
        "scripts"=>array(),
        "styles"=>array(),
    );
>>>>>>> version 2.0 start
    //store specific layouts
    private $styles=array();
    private $scripts=array();
    
    function __construct() {
<<<<<<< HEAD
        $this->addPath("template", "engine/view/themes/template/template.php");
        $this->addPath("theme", "engine/view/themes/");
        $this->addPath("theme_styles", "engine/view/themes/styles/");
        $this->addPath("theme_scripts", "engine/view/themes/scripts/");
        $this->addPath("theme_images", "engine/view/themes/images/");
        $this->addPath("default_style", "engine/view/Default/style.php");
        $this->addPath("default_script", "engine/view/Default/script.php");
=======
        $this->addPath("shell", "engine/core/view/Default/page_shell.php");
        $this->addPath("theme", "engine/view/theme/");
        $this->addPath("theme_images", "engine/view/theme/images/");
        $this->addPath("default_style", "style.php");
        $this->addPath("default_script", "script.php");
>>>>>>> version 2.0 start
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
<<<<<<< HEAD
        if($cfg_array["category"]=="page") require_once $this->getPath("template");
        else {
            $this->loadHeaders();
=======
        if($cfg_array["category"]=="page") {
            if($this->usesTemplate) {
                $page_content=$this->getPath ('theme')."template/".$this->theme['template'];
                $template_body=$this->getViewPath().$file;
            }
            else $page_content=$this->getViewPath().$file;
            $headers=$this->getHeaders($cfg_array["category"]);
            require_once $this->getPath("shell");
        }
        else {
            $headers=$this->getHeaders($cfg_array["category"]);
            foreach($headers as $h) require_once $h;
>>>>>>> version 2.0 start
            require_once $this->getViewPath().$file;
        }
    }
    
<<<<<<< HEAD
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
=======
    private function getHeaders($category) {
        $headers=array();
        if(($this->getLayoutName()=="theme" || $this->getLayoutName()=="both") && $category=="page") {
            foreach($this->theme["styles"] as $s) array_push($headers,$this->getPath("theme")."styles/".$s);
            foreach($this->theme["scripts"] as $s) array_push($headers,$this->getPath("theme")."scripts/".$s);
        }
        if($this->getLayoutName()=="specific" || $this->getLayoutName()=="both") {
            foreach($this->styles as $s) array_push($headers,$this->getViewPath().$s);
            foreach($this->scripts as $s) array_push($headers,$this->getViewPath().$s);
        }
        if($this->getLayoutName()=="default") {
            array_push($headers,$this->getViewPath().$this->getPath("default_style"));
            array_push($headers,$this->getViewPath().$this->getPath("default_script"));
            foreach($this->scripts as $s) array_push($headers,$this->getViewPath().$s);
        }
        return $headers;
>>>>>>> version 2.0 start
    }
    
    private function loadTheme() {
        $xml=simplexml_load_file($this->getPath("theme")."themecfg.xml");
        foreach($xml->children() as $child) {
<<<<<<< HEAD
            if($child->getName()=="scripts") {
                foreach($child->children() as $c) array_push($this->theme_scripts, $c);
            }
            else if($child->getName()=="styles") {
                foreach($child->children() as $c) array_push($this->theme_styles,$c);
=======
            if($child->getName()=="template") $this->theme['template']=$child;
            if($child->getName()=="scripts") {
                foreach($child->children() as $c) array_push($this->theme['scripts'], $c);
            }
            else if($child->getName()=="styles") {
                foreach($child->children() as $c) array_push($this->theme['styles'],$c);
>>>>>>> version 2.0 start
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
