<?php

class DefaultController extends Controller {
    
    public $usesModel=true;
    public $usesView=true;
    public $modules=array();
    public $helpers=array("html","css");
    public $layout="default";
    public $viewType="HTML";

    public function loadDefaultView() {
        $this->view->renderView("default");
    }
}

?>
