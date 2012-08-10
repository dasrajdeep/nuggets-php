<?php

class Upload {
    public $upload_dir;
    public $serverHandler;
    
    function __construct() {
        $this->upload_dir=Engine::path("repository");
        if($this->upload_dir==NULL) $this->upload_dir=Engine::path("uploader")."server/uploads/";
        $this->serverHandler=Engine::path("uploader")."server/php.php";
    }
    
<<<<<<< HEAD
    public function upload() {
=======
    public function upload($subdir) {
        $this->upload_dir.=$subdir.'/';
        $upload_dir=  $this->upload_dir;
>>>>>>> version 2.0 start
        require_once $this->serverHandler;
    }
}

?>
