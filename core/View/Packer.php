<?php
/**
 * This file contains the Packer class.
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
 * This class is required for packing requested files.
 * 
 * @package    nuggets\View
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 3.6
 */
class Packer {
	
	private $outputDir=null;
	
	function __construct($outputDir) {
		$this->outputDir=$outputDir;
	}
	
	function packStyles(&$styles=null) {
		$stylesheet='';
		$f=null;
		foreach($styles as $s) {
			$f=fopen($s,'r');
			$content=fread($f,filesize($s));
			$stylesheet.=$content."\n";
			fclose($f);
		}
		$f=fopen($this->outputDir.'view.style.css','w+');
		fwrite($f,$stylesheet);
		fclose($f);
		array_splice($styles,0);
		array_push($styles,$this->outputDir.'view.style.css');
	}
	
	function packScripts(&$scripts=null) {
		$script='';
		$f=null;
		foreach($scripts as $s) {
			$f=fopen($s,'r');
			$content=fread($f,filesize($s));
			$script.=$content."\n";
			fclose($f);
		}
		$f=fopen($this->outputDir.'view.script.js','w+');
		fwrite($f,$script);
		fclose($f);
		array_splice($scripts,0);
		array_push($scripts,$this->outputDir.'view.script.js');
	}
}
?>
