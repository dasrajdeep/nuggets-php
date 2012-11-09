<?php

class HTMLView extends View {
    
    //store the theme layouts
    private $theme=array(
        "template"=>"",
        "scripts"=>array(),
        "styles"=>array(),
    );
    //store specific layouts
    private $styles=array();
    private $scripts=array();
    
    function __construct() {
        $this->addPath("shell", "core/view/Default/page_shell.php");
        $this->addPath("theme", "app/view/theme/");
        $this->addPath("theme_images", "app/view/theme/images/");
        $this->addPath("default_style", "style.php");
        $this->addPath("default_script", "script.php");
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
            require_once $this->getViewPath().$file;
        }
    }
    
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
    }
    
    private function loadTheme() {
        $xml=simplexml_load_file($this->getPath("theme")."themecfg.xml");
        foreach($xml->children() as $child) {
            if($child->getName()=="template") $this->theme['template']=$child;
            if($child->getName()=="scripts") {
                foreach($child->children() as $c) array_push($this->theme['scripts'], $c);
            }
            else if($child->getName()=="styles") {
                foreach($child->children() as $c) array_push($this->theme['styles'],$c);
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
