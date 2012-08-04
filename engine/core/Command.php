<?php
    class Command {
        private $command='';
        private $parameters=array();

        function __construct($commandArray) {
            $this->command=$commandArray[0];
            $this->parameters=array_slice($commandArray,1);
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
    }
?>