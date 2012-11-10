<?php

class Command {
	private $command=null;
	private $parameters=array();
	private $data=null;

	function __construct($commandArray) {
		$this->command=$commandArray[0];
		$this->data=$_POST;
		$pairs=array_slice($commandArray,1);
		foreach($pairs as $p) {
			$pair=explode("=",$p);
			$this->parameters[$pair[0]]=$pair[1];
		}
	}
	function setCommand($cmd) {
		$this->command=$cmd;
	}

	function getCommand() {
		return $this->command;
	}
	
	function getParameters() {
		return $this->parameters;
	}
	
	function getData() {
		return $this->data;
	}
}

?>