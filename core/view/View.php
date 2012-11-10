<?php

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
    
    public function getEntityName() {
        return $this->name;
    }
    
    public function getVar($key) {
        return $this->viewVars[$key];
    }
    
    public function getViewPath() {
        return $this->viewPath;
    }
    
    public function getViewName() {
        return $this->viewName;
    }
    
    public function getLayoutName() {
        return $this->layout;
    }
    
    public function getExtension() {
        return $this->ext;
    }
    
    public function addPath($name,$path) {
        $this->paths[$name]=$path;
    }
    
    public function getPath($name) {
        return $this->paths[$name];
    }
}

?>
