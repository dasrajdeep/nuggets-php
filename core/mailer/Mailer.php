<?php
//PEAR Mail must be installed.

class Mailer {
    
    public function sendMail($contact,$msg_text,$msg_html,$subject) {
        $this->loadDependancies();
        //Header information.
        $from=Config::read("mail_sender")." <".Config::read("mail_username").">";
        $to="<".$contact.">";
        $headers = array ('From' => $from,'To' => $to,'Subject' => $subject);
        //Message details.
        $mime=new Mail_mime();
        $mime->setTXTBody($msg_text);
        $mime->setHTMLBody($msg_html);
        $body=$mime->get();
        $headers=$mime->headers($headers);
        //Creation and sending of mail.
        $smtp = Mail::factory('smtp',array ('host' => Config::read("mail_host"),'port' => Config::read("mail_port"),'auth' => true,'username' => Config::read("mail_username"),'password' => Config::read("mail_password")));
        $mail = $smtp->send($to, $headers, $body);
        //Handling errors.
        if (PEAR::isError($mail)) return false; 
        else return true;
    }
    
    public function loadDependancies() {
        require_once("Mail.php");
        require_once("Mail/mime.php");
    }
}

?>