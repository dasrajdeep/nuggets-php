<?php
/**
 * This file contains the StyleParser class.
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

require_once('core/Helper/CSSHelper.php');

/**
 * This class provides a parser for custom CSS styles.
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
class StyleParser {
	
	/**
	 * Contains the regular expressions for matching custom CSS tags.
	 * 
	 * @var mixed[]
	 */
	private $matcher=array(
		'gradient'=>'/gradient[\s]*:[\s]*#([0-9a-fA-F]{3,6})[\s]*#([0-9a-fA-F]{3,6})[\s]*;/',
		'shadow'=>'/shadow[\s]*:[\s]*(inset)?[\s]*([0-9]+)px[\s]*([0-9]+)px[\s]*([0-9]+)px[\s]*#([0-9a-fA-F]{3,6})[\s]*;/',
		'transparency'=>'/transparency[\s]*:[\s]*(0\.[0-9]+|1)[\s]*;/'
	);
	
	/**
	 * Parses a stylesheet and returns a processed string.
	 * 
	 * @param string $file
	 * @return string
	 */
	function parse($file) {
		$handle=fopen($file,'r+');
		$size=filesize($file);
		$contents=fread($handle,$size);
		
		$contents=preg_replace_callback($this->matcher['gradient'],array($this,'replacer'),$contents);
		$contents=preg_replace_callback($this->matcher['shadow'],array($this,'replacer'),$contents);
		$contents=preg_replace_callback($this->matcher['transparency'],array($this,'replacer'),$contents);
		
		fclose($handle);
		
		return $contents;
	}
	
	/**
	 * A callback for the parser.
	 * 
	 * @param string[] $match
	 * @return string
	 */
	function replacer($match) {
		if(strpos($match[0],'gradient')===0) {
			return CSSHelper::getGradient($match[1],$match[2]);
		} else if(strpos($match[0],'shadow')===0) {
			return CSSHelper::getShadow($match[2],$match[3],$match[4],$match[5],$match[1]);
		} else if(strpos($match[0],'transparency')===0) {
			return CSSHelper::getTransparency($match[1]);
		}
		return $match[0];
	}
	
	/**
	 * Modifies the stylesheet.
	 * 
	 * @param string $css
	 * @param string $file
	 */
	function transform($css,$file) {
		$fp=fopen($file,'w+');
		fwrite($fp,$css);
		fclose($fp);
	}
}
?>
