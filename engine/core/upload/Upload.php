<?php

class Upload {
    public $upload_dir;
    public $serverHandler;
    
    function __construct() {
        $this->upload_dir=Engine::path("repository");
        if($this->upload_dir==NULL) $this->upload_dir=Engine::path("uploader")."server/uploads/";
        $this->serverHandler=Engine::path("uploader")."server/php.php";
    }
    
    public function upload() {
        require_once $this->serverHandler;
    }
}

?>
