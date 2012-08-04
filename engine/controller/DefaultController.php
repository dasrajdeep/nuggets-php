<?php

class DefaultController extends Controller {
    
    public $usesModel=TRUE;
    public $usesView=TRUE;
    public $modules=array();
    public $helpers=array("html","css");
    public $layout="default";
    public $viewType="HTML";

    public function loadDefaultView() {
        $this->view->renderView("default");
    }
    
    public function loadConfigView() {
        $this->model->generateConfigData();
        $this->view->renderView("config");
    }
    
    public function saveConfig() {
        $params=$this->getParams();
        $result=$this->model->saveConfig($params);
        if($result) $this->setResponse("success");
        else $this->setResponse("failure");
    }
}

?>