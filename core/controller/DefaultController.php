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
}

?>
