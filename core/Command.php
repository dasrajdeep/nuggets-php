<?php
    class Command {
        private $command='';
        private $parameters=array();
		private $data=null;

        function __construct($commandArray) {
            $this->command=$commandArray[0];
            $this->parameters=array_slice($commandArray,1);
			$this->data=$_POST;
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