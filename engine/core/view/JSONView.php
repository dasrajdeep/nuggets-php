<?php
    class JSONView extends View {
        
        public $jsonObjects;
        
        public function renderView() {
            $keys=array_keys($this->viewVars);
            foreach($keys as $k) echo json_encode($this->viewVars[$k]); 
        }
        
    }
?>
