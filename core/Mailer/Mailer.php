<?php
/**
 * This file contains the Mailer class.
 * 
 * PHP version 5.3
 * 
 * LICENSE: This file is part of Nuggets-PHP.
 * Nuggets-PHP is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * Nuggets-PHP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Nuggets-PHP. If not, see <http://www.gnu.org/licenses/>. 
 */
namespace nuggets;

/**
 * This class provides mailing features.
 * 
 * @package    nuggets\Mailer
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 1.0
 */
class Mailer {
    
    /**
     * Sends a mail.
     * 
     * @param string $contact
     * @param string $msg_text
     * @param string $msg_html
     * @param string $subject
     * @return boolean
     */
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
    
    /**
     * Loads dependancies for sending a mail.
     */
    public function loadDependancies() {
        require_once("Mail.php");
        require_once("Mail/mime.php");
    }
}

?>
