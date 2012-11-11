<?php

class Dispatcher {
    private $command;
    
    function __construct($command) {
        $this->command=$command;
        if(Engine::engineError()) {
            $cmd=$this->command->getCommand();
            if(!NuggetsRegistry::isEngineCommand($cmd)) $cmd="master";
            $this->command->setCommand($cmd);
        }
    }
    
    public function dispatch() {
        $cmd=$this->command->getCommand();
        $params=$this->command->getParameters();
        
        if($cmd==NULL) $cmd="default";
        
        $route=NuggetsRegistry::getRoute($cmd);
		
		if(!$route) {
			require_once('static/invalidCommand.php');
			die();
		}
		
        $controllerName=$route[0]."Controller";
        require_once('core/controller/Controller.php');
        
        if(NuggetsRegistry::isEngineCommand($cmd) || $route[0]==="Default") require_once(sprintf('core/controller/%s.php',$controllerName));
        else require_once(sprintf('app/controller/%s.php',$controllerName));
		
        $controller=new $controllerName();
        if(NuggetsRegistry::isEngineCommand($cmd) || $route[0]==="Default") $controller->core=true;
        $this->initController($controller,$route[0],$params);
        $controller->$route[1]();
        echo $controller->getResponse();
    }
    
    private function initController($controller,$entity,$params) {
        $controller->name=$entity;
        $controller->uses=$controller->modules;
        $controller->requestParams=$params;
        if($entity!=="Default") $controller->viewPath=sprintf("app/view/%s/",$entity);
        $controller->methods=get_class_methods($controller);
        $controller->init();
    }
}

?>