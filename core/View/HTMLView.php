<?php
/**
 * This file contains the HTMLView class.
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

require_once('core/View/View.php');

/**
 * This class represents a HTML view.
 * 
 * @package    nuggets\View
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 1.0
 */
class HTMLView extends View {
	
	private $libScript=array(
		'jquery.js',
		'base64.js',
		'utility.js',
		'appearance.js',
		'loader.js'
	);
	
	private $config=null;
	
	public function uncompressThemeFiles() {
		
		$zip=zip_open('app/theme/theme.zip');
		
		while($entry=zip_read($zip)) {
			
			$data=zip_entry_read($entry,zip_entry_filesize($entry));
			
			$entryName=zip_entry_name($entry);
			
			if(substr($entryName,strlen($entryName)-1,1)=="/") mkdir('app/theme/'.$entryName); 
			else file_put_contents('app/theme/'.zip_entry_name($entry),$data);
		}
	}
	
	public function addComponent($viewName) {
		
		$view=$this->config[$viewName];
		
		require_once($this->getViewPath().$view['file']);
	}
	
	/**
	 * Renders a view in HTML.
	 * 
	 * @param string $view
	 */
    public function renderView($view) {
        $this->config=parse_ini_file($this->getViewPath().'view.ini',true);
        
        if(!file_exists('app/theme/theme.ini')) {
			$this->uncompressThemeFiles();
			
			file_put_contents('app/theme/theme.ini',"
				template_file=default_template.php\n
				\n
				style[]=default.css\n
				\n
				script[]=default.js\n
				\n
				image[]=\n
			");
		}
        
		$theme=parse_ini_file('app/theme/theme.ini');
		
		$view=$this->config[$view];
		
		if(!isset($view['style'])) $view['style']=array();
		if(!isset($view['script'])) $view['script']=array();
		
		$layout=$this->getLayoutName();
		
		$tag_script='<script src="%s"></script>';
		$tag_style='<link rel="stylesheet" href="%s" />';
		
		$styles=array();
		$scripts=array();
		
		$libPath=Registry::getPath('scriptlib');
		foreach($this->libScript as $l) array_push($scripts,$libPath.$l);
		
		foreach($view['script'] as $s) array_push($scripts,$this->getViewPath().$s);
		
		if($layout==='default') {
			array_push($styles,'core/View/layout/style.css');
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
		
		$this->parseStyles($styles);
		$this->pack($styles,$scripts);
		
		if($view['category']==='page') {
			if($this->usesTemplate) {
				$page_content='app/theme/template/'.$theme['template_file'];
				$template_body=$this->getViewPath().$view['file'];
			} else $page_content=$this->getViewPath().$view['file'];
			require_once('core/View/template.inc');
		} else {
			foreach($styles as $s) echo sprintf($tag_style,$s);
			foreach($scripts as $s) echo sprintf($tag_script,$s);
			require_once($this->getViewPath().$view['file']);
		}
    }
    
    function pack(&$styles,&$scripts) {
		require_once('core/View/Packer.php');
		$packer=new Packer($this->getViewPath());
		$packer->packScripts($scripts);
		$packer->packStyles($styles);
	}
	
    /**
     * Parses custom styles in stylesheets and generates custom styles.
     * 
     * @param string[] $stylesheets
     */
    function parseStyles($stylesheets) {
		require_once('core/View/StyleParser.php');
		$parser=new StyleParser();
		foreach($stylesheets as $file) {
			$lastmod=Config::read($file,'tracker');
			if($lastmod && $lastmod>=filemtime($file)) continue;
			$parsed=$parser->parse($file);
			if($parsed[0]==0) continue;
			copy($file,$file.'.raw');
			$parser->transform($parsed[1],$file);
			Config::write($file,filemtime($file));
		}
	}
}

?>
