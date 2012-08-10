<?php

class Controller {
    
    //name of this entity
    public $name;
    //name of this controller
    public $controllerName;
    //core modules used by this controller
    public $uses;
    //helpers used by this controller
    public $helpers;
    //array of parameters sent by http request
    public $requestParams;
    //response sent out by engine
    public $response=NULL;
    //path to views of this controller
<<<<<<< HEAD
    public $viewPath="engine/view/Default/";
=======
    public $viewPath="engine/core/view/Default/";
>>>>>>> version 2.0 start
    //variables to be handed over to the view
    public $viewVars=array();
    //layout to be used fo view used by this controller
    public $layout="default";
    //instance of the view class created during rendering
    public $view;
    //instance of the model class created
    public $model=NULL;
    //checks if controller uses a model
    public $usesModel;
    //checks if controller uses a view
    public $usesView;
    //type fo view to be rendered
    public $viewType="HTML";
<<<<<<< HEAD
=======
    //template support
    public $usesTemplate=false;
>>>>>>> version 2.0 start
    //extention for view files
    public $ext="php";
    //methods of this controller
    public $methods;
<<<<<<< HEAD
=======
    //core or user-defined
    public $core=false;
>>>>>>> version 2.0 start

    public function init() {
        Engine::uses("View");
        Engine::uses("Model");
        $this->controllerName=$this->name."Controller";
<<<<<<< HEAD
        foreach($this->uses as $m) Engine::uses ($m);
=======
        foreach($this->uses as $m) Engine::uses($m);
>>>>>>> version 2.0 start
        foreach($this->helpers as $h) Engine::helper($h);
        //declare model
        if($this->usesModel) {
            $modelName=$this->name."Model";
<<<<<<< HEAD
            import("nuggets.model.".$modelName);
=======
            if($this->core) import("nuggets.core.model.".$modelName);
            else import("nuggets.model.".$modelName);
>>>>>>> version 2.0 start
            $this->model=new $modelName();
            //init model
            $model=$this->model;
            $model->name=$this->name;
            $model->data=&$this->viewVars;
            foreach($model->core as $c) array_push($model->coreModules, $c);
            $model->init();
        }
        if($this->usesView) {
            $viewName=$this->viewType."View";
            Engine::uses($viewName);
            $this->view=new $viewName();
            //init view
            $view=$this->view;
            $view->name=$this->name;
            $view->viewPath=$this->viewPath;
            $view->viewName=$viewName;
            $view->layout=$this->layout;
            $view->ext=$this->ext;
            $view->viewVars=&$this->viewVars;
<<<<<<< HEAD
=======
            $view->usesTemplate=$this->usesTemplate;
>>>>>>> version 2.0 start
        }
    }
    
    public function getEntityName() {
        return $this->name;
    }
    
    public function getDependantModules() {
        return $this->uses;
    }
    
    public function getDependantHelpers() {
        return $this->helpers;
    }
    
    public function getViewPath() {
        return $this->viewPath;
    }
    
    public function setVar($key,$value) {
        $this->viewVars[$key]=$value;
    }
    
    public function getvar($key) {
        return $this->viewVars[$key];
    }
    
    public function getLayout() {
        return $this->layout;
    }
    
    public function getViewType() {
        return $this->viewType;
    }
    
    public function getViewExtension() {
        return $this->ext;
    }
    
    public function getMethods() {
        return $this->methods;
    }
    
    public function setResponse($response) {
        $this->response=$response;
    }
    
    public function getResponse() {
        return $this->response;
    }
    
    public function getParams() {
        return $this->requestParams;
    }
}

?>
