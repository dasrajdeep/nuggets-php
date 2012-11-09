<?php

class Upload {
    public $upload_dir;
    public $serverHandler;
    
    function __construct() {
        $this->upload_dir=Registry::getPath("repository");
        if($this->upload_dir==NULL) $this->upload_dir=Registry::getPath("uploader")."server/uploads/";
        $this->serverHandler=Registry::getPath("uploader")."server/php.php";
    }
    
    public function upload($subdir) {
        $this->upload_dir.=$subdir.'/';
        $upload_dir=  $this->upload_dir;
        require_once $this->serverHandler;
    }
}

?>
