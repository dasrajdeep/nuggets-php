<?php

class Dispatcher {
    private $command;
    
    function __construct($command) {
        $this->command=$command;
        if(Engine::engineError()) {
            $cmd=$this->command->getCommand();
            if(!Registry::isEngineCommand($cmd)) $cmd="master";
            $this->command->setCommand($cmd);
        }
    }
    
    public function dispatch() {
        $cmd=$this->command->getCommand();
        $params=$this->command->getParameters();
        
        if($cmd==NULL) $cmd="default";
        $params=$this->formParamPairs($params);
        
        $route=Registry::getRoute($cmd);
        $controllerName=$route[0]."Controller";
        Engine::uses("Controller");
        
        if(Registry::isEngineCommand($cmd)) require_once(sprintf('core/controller/%s.php',$controllerName));
        else require_once(sprintf('app/controller/%s.php',$controllerName));
        $controller=new $controllerName();
        if(Registry::isEngineCommand($cmd)) $controller->core=true;
        $this->initController($controller,$route[0],$params);
        $controller->$route[1]();
        echo $controller->getResponse();
    }
    
    private function initController($controller,$entity,$params) {
        $controller->name=$entity;
        $controller->uses=$controller->modules;
        $controller->requestParams=$params;
        if($entity!="Default") $controller->viewPath=sprintf("app/view/%s/",$entity);
        $controller->methods=get_class_methods($controller);
        $controller->init();
    }

    private function formParamPairs($params) {
        $pairs=array();
        foreach($params as $p) {
            $pair=$this->getParamPair($p);
            $pairs[$pair[0]]=$pair[1];
        }
        return $pairs;
    }
    
    private function getParamPair($param) {
        $data=base64_decode($param);
        if($data!=FALSE) $param=$data;
        $pair=explode("=", $param);
        if(count($pair)!=2) return false;
        return $pair;
    }
}

?>