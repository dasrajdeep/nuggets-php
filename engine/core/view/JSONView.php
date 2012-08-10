<?php
    class JSONView extends View {
        
        public function renderView($var) {
            echo json_encode($this->viewVars[$var]); 
        }
        
    }
?>
