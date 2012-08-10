<?php

class Authentication {
    
    protected $auth_table;
    protected $field_id;
    protected $auth_type;
    protected $encryption;
    protected $user_id=null;

    public function setUserID($auth_field,$auth_id) {
        $set=Database::get($this->auth_table, $this->field_id,sprintf("%s='%s'",$auth_field,$auth_id));
        if($set==NULL) return NULL;
        $set=$set[0];
        $this->user_id=$set[$this->field_id];
    }
    
    protected function authorize() {
        Session::start($this->user_id);
        Session::setAuthorized(TRUE);
    }
}

?>
