<?php
namespace nuggets;

require_once('core/view/View.php');

class HTMLView extends View {

    public function renderView($view) {
        $cfg=parse_ini_file($this->getViewPath().'view.ini',true);
		$theme=parse_ini_file('app/theme/theme.ini');
		
		$view=$cfg[$view];
		
		if(!isset($view['style'])) $view['style']=array();
		if(!isset($view['script'])) $view['script']=array();
		
		$layout=$this->getLayoutName();
		
		$tag_script='<script src="%s"></script>';
		$tag_style='<link rel="stylesheet" href="%s" />';
		
		$styles=array();
		$scripts=array();
		
		foreach($view['script'] as $s) array_push($scripts,$this->getViewPath().$s);
		
		if($layout==='default') {
			array_push($scripts,'core/view/Default/script.js');
			array_push($styles,'core/view/Default/style.css');
		} else if($layout==='theme') {
			foreach($theme['style'] as $s) array_push($styles,'app/theme/styles/'.$s);
			foreach($theme['script'] as $s) array_push($scripts,'app/theme/scripts/'.$s);
		} else if($layout==='specific') {
			foreach($view['style'] as $s) array_push($styles,$this->getViewPath().$s);
		} else if($layout==='both') {
			foreach($theme['style'] as $s) array_push($styles,'app/theme/styles/'.$s);
			foreach($theme['script'] as $s) array_push($scripts,'app/theme/scripts/'.$s);
			foreach($view['style'] as $s) array_push($styles,$this->getViewPath().$s);
		}
		
		if($view['category']==='page') {
			if($this->usesTemplate) {
				$page_content='app/theme/template/'.$theme['template_file'];
				$template_body=$this->getViewPath().$view['file'];
			} else $page_content=$this->getViewPath().$view['file'];
			require_once('core/view/template.inc');
		} else {
			foreach($styles as $s) echo sprintf($tag_style,$s);
			foreach($scripts as $s) echo sprintf($tag_script,$s);
			require_once($this->getViewPath().$view['file']);
		}
    }
}

?>
