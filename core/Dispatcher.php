<?php
/**
 * This file contains the Dispatcher class.
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
 * This class performs dispatching of procedures based on commands.
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
class Dispatcher {
	
	/**
	 * Contains the command object.
	 * 
	 * @var Command
	 */
    private $command=null;
    
    /**
     * Initializes the dispatcher.
     * 
     * @param Command $command
     */
    function __construct($command) {
        $this->command=$command;
        if(Engine::engineError()) nuggetsErrorHandler();
    }
    
    /**
     * Dispatches a controller.
     */
    public function dispatch() {
        $cmd=$this->command->getCommand();
        $params=$this->command->getParameters();
        
        if($cmd==NULL) $cmd="default";
        
        $route=Registry::getRoute($cmd);
		
		if(!$route) {
			require_once('static/invalidCommand.php');
			die();
		}
		
        $controllerName=$route[0]."Controller";
		
		$class='nuggets\\'.$controllerName;
        $controller=new $class();
		
        if(Registry::isEngineCommand($cmd) || $route[0]==="Default") $controller->core=true;
        $this->initController($controller,$route[0],$params);
        $controller->$route[1]();
        echo $controller->getResponse();
    }
    
    /**
     * Initializes a controller that is dispatched by this object.
     * 
     * @param object $controller
     * @param string $entity
     * @param mixed[] $params
     */
    private function initController($controller,$entity,$params) {
        $controller->name=$entity;
        $controller->requestParams=$params;
        if(in_array($entity,array('Default','Admin'))) $controller->viewPath.=$entity.'/';
        else $controller->viewPath=sprintf("app/view/%s/",$entity);
        $controller->methods=get_class_methods($controller);
        $controller->init();
    }
}

?>
