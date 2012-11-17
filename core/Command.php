<?php
/**
 * This file contains the Command class.
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
 * This class interprets the commands supplied to the URL request.
 * 
 * @package    nuggets
 * @category   PHP
 * @author     Rajdeep Das <das.rajdeep97@gmail.com>
 * @copyright  Copyright 2012 Rajdeep Das
 * @license    http://www.gnu.org/licenses/gpl.txt  The GNU General Public License
 * @version    GIT: v3.5
 * @link       https://github.com/dasrajdeep/nuggets-php
 * @since      Class available since Release 1.0
 */
class Command {
	
	/**
	 * Contains the command.
	 * 
	 * @var string
	 */
	private $command=null;
	
	/**
	 * Contains the parameters of the URL request.
	 * 
	 * @var mixed[]
	 */
	private $parameters=array();
	
	/**
	 * Contains the POST data associated with the URL request.
	 * 
	 * @var mixed[]
	 */
	private $data=null;
	
	/**
	 * Extracts the command and parameters from the URL request.
	 * 
	 * @param string[] $commandArray
	 */
	function __construct($commandArray) {
		$this->command=$commandArray[0];
		$this->data=$_POST;
		$pairs=array_slice($commandArray,1);
		foreach($pairs as $p) {
			if(preg_match('/^.*=.*$/',$p)!==1) continue;
			$pair=explode("=",$p);
			$this->parameters[$pair[0]]=$pair[1];
		}
	}
	
	/**
	 * Manually sets the command for this command object.
	 * 
	 * @param string $cmd
	 */
	function setCommand($cmd) {
		$this->command=$cmd;
	}
	
	/**
	 * Fetches the command stored by this object.
	 * 
	 * @return string
	 */
	function getCommand() {
		return $this->command;
	}
	
	/**
	 * Fetches the parameters stored by this command object.
	 * 
	 * @return string[]
	 */
	function getParameters() {
		return $this->parameters;
	}
	
	/**
	 * Fetches the post data supplied with the request.
	 * 
	 * @return mixed[]
	 */
	function getData() {
		return $this->data;
	}
}

?>
