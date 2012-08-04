<?php

class AJAXPoll {
    
    public $sessionID;

    public function startSession($id) {
        $_SESSION['lastpoll']=time();
        $this->sessionID=$_SESSION[$id];
    }
    
    public function pollNow() {
        if(!isset($_SESSION['lastpoll'])) return FALSE;
        $last=$_SESSION['lastpoll'];
        $_SESSION['lastpoll']=time();
        return $last;
    }
    
    public function isPolling() {
        return isset($_SESSION['lastpoll']);
    }
    
    public function stopSession() {
        unset($_SESSION['lastpoll']);
    }
}

?>
