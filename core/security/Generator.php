<?php

class Generator {
    
    public function generatePassword($length) {
        $chars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $size=strlen($chars);
        $generated='';
        for($i=0;$i<$length;$i++) $generated.=substr($chars,rand(0,$size-1),1);
        return $generated;
    }
}

?>
