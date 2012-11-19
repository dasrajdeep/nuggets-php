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
 * @package    nuggets\Controller
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 1.0
 */
class Controller {
    
    /**
     * Contains the name of this module.
     * 
     * @var string
     */
    public $name;
    
    /**
     * Contains the name of the controller.
     * 
     * @var string
     */
    public $controllerName;
    
    /**
     * Contains the helpers used by the controller.
     * 
     * @var string[]
     */
    public $helpers;
    
    /**
     * Contains the URL request parameters.
     * 
     * @var mixed[]
     */
    public $requestParams;
	
	/**
	* Contains the POST data from the request.
	*
	* @var mixed[]
	*/
	public $postData;
    
    /**
     * Contains the response set by the module.
     * 
     * @var mixed
     */
    public $response=NULL;
    
    /**
     * Contains the path to the view for this controller.
     * 
     * @var string
     */
    public $viewPath="core/View/";
    
    /**
     * Contains the variables for the view.
     * 
     * @var mixed[]
     */
    public $viewVars=array();
    
    /**
     * Layout used by this module.
     * 
     * @var string
     */
    public $layout="default";
    
    /**
     * Instance of the view class created during rendering.
     * 
     * @var object
     */
    public $view;
    
    /**
     * Instance of the model class for this module.
     * 
     * @var object
     */
    public $model=NULL;
    
    /**
     * A flag to check if controller uses a model.
     * 
     * @var boolean
     */
    public $usesModel;
    
    /**
     * A flag to check if controller uses a view.
     * 
     * @var boolean
     */
    public $usesView;
    
    /**
     * Contains the type of view to be rendered.
     * 
     * @var string
     */
    public $viewType="HTML";
    
    /**
     * Checks whether the view for this module uses a template.
     * 
     * @var boolean
     */
    public $usesTemplate=false;
    
    /**
     * A flag which tells if the module is a core module.
     * 
     * @var boolean
     */
    public $core=false;

	/**
	 * Initializes the controller.
	 */
    public function init() {
        $this->controllerName=$this->name."Controller";
        foreach($this->helpers as $h) Engine::helper($h);
        //initialize model
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
			$this->viewType=strtoupper($this->viewType);
            $viewName='nuggets\\'.$this->viewType."View";
            $this->view=new $viewName();
            //init view
            $view=$this->view;
            $view->name=$this->name;
            $view->viewPath=$this->viewPath;
            $view->viewName=$viewName;
            $view->layout=strtolower($this->layout);
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
	
	/**
	* Fetches the POST data received with the request.
	*
	* @return mixed[]
	*/
	public function getPostData() {
		return $this->postData;
	}
}

?>
