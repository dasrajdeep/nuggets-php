<?php

class Model {
    
    //name of entity
    public $name="";
    //data fetched or generated from model
    public $data=array();
    //tables in database used by this model
    public $tables=array();
    //core modules used by this model
    public $coreModules=array();

    public function init() {
        foreach($this->coreModules as $c) Engine::uses($c);
    }
    
    public function getEntityName() {
        return $this->name;
    }
    
    public function setData($id,$set) {
        $this->data[$id]=$set;
    }
    
    public function getData() {
        return $this->data;
    }
    
    public function getTables() {
        return $this->tables;
    }
}

?>
