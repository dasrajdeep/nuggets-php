<?php
/**
 * This file contains the Controller class.
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
 * This class provides the general controller features.
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
    public $viewPath="core/View/Default/";
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
    //template support
    public $usesTemplate=false;
    //extention for view files
    public $ext="php";
    //methods of this controller
    public $methods;
    //core or user-defined
    public $core=false;

	/**
	 * Initializes the controller.
	 */
    public function init() {
        $this->controllerName=$this->name."Controller";
        foreach($this->uses as $m) Engine::uses($m);
        foreach($this->helpers as $h) Engine::helper($h);
        //declare model
        if($this->usesModel) {
			require_once('core/Model/Model.php');
            $modelName='nuggets\\'.$this->name."Model";
            $this->model=new $modelName();
            //init model
            $model=$this->model;
            $model->name=$this->name;
            $model->data=&$this->viewVars;
            foreach($model->core as $c) array_push($model->coreModules, $c);
            $model->init();
        }
        if($this->usesView) {
            $viewName='nuggets\\'.$this->viewType."View";
            $this->view=new $viewName();
            //init view
            $view=$this->view;
            $view->name=$this->name;
            $view->viewPath=$this->viewPath;
            $view->viewName=$viewName;
            $view->layout=$this->layout;
            $view->ext=$this->ext;
            $view->viewVars=&$this->viewVars;
            $view->usesTemplate=$this->usesTemplate;
        }
    }
    
    /**
     * Fetches the name of the entity associated with this controller.
     * 
     * @return string
     */
    public function getEntityName() {
        return $this->name;
    }
    
    /**
     * Fetches the dependant modules for this controller.
     * 
     * @return string[]
     */
    public function getDependantModules() {
        return $this->uses;
    }
    
    /**
     * Fetches the required helpers for this controller.
     * 
     * @return string[]
     */
    public function getDependantHelpers() {
        return $this->helpers;
    }
    
    /**
     * Fetches the path to the view for this controller.
     * 
     * @return string
     */
    public function getViewPath() {
        return $this->viewPath;
    }
    
    /**
     * Sets a variable for this module object.
     * 
     * @param string $key
     * @param mixed $value
     */
    public function setVar($key,$value) {
        $this->viewVars[$key]=$value;
    }
    
    /**
     * Fetches a variable previously stored.
     * 
     * @param string $key
     * @return mixed
     */
    public function getvar($key) {
        return $this->viewVars[$key];
    }
    
    /**
     * Fetches the layout associated with this controller.
     * 
     * @return string
     */
    public function getLayout() {
        return $this->layout;
    }
    
    /**
     * Fetches the type of view for this controller.
     * 
     * @return string
     */
    public function getViewType() {
        return $this->viewType;
    }
    
    /**
     * Fetches the extension type for the view.
     * 
     * @return string
     */
    public function getViewExtension() {
        return $this->ext;
    }
    
    /**
     * Fetches the methods defined for this controller.
     * 
     * @return string[]
     */
    public function getMethods() {
        return $this->methods;
    }
    
    /**
     * Sets the response for this controller.
     * 
     * @param string $response
     */
    public function setResponse($response) {
        $this->response=$response;
    }
    
    /**
     * Fetches the response for this controller.
     * 
     * @return string
     */
    public function getResponse() {
        return $this->response;
    }
    
    /**
     * Fetches the parameters provided with the URL request.
     * 
     * @return mixed[]
     */
    public function getParams() {
        return $this->requestParams;
    }
}

?>
