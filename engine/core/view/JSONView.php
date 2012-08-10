<?php
    class JSONView extends View {
        
<<<<<<< HEAD
        public $jsonObjects;
        
        public function renderView() {
            $keys=array_keys($this->viewVars);
            foreach($keys as $k) echo json_encode($this->viewVars[$k]); 
=======
        public function renderView($var) {
            echo json_encode($this->viewVars[$var]); 
>>>>>>> version 2.0 start
        }
        
    }
?>
