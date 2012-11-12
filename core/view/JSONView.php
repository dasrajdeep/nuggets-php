<?php
namespace nuggets;

require_once('core/view/View.php');

class JSONView extends View {
	
	public function renderView($var) {
		echo json_encode($this->viewVars[$var]); 
	}
	
}

?>
