<?php   
/**
 * This file contains the procedures required to load and run the framework.
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

require_once 'bootstrap.php';

$requestURI=explode('/',$_SERVER['REQUEST_URI']);
$scriptName=explode('/',$_SERVER['SCRIPT_NAME']);

for($i=0;$i<sizeof($scriptName);$i++) {
		if ($requestURI[$i]==$scriptName[$i]) unset($requestURI[$i]);
}

$commandArray=array_values($requestURI);
$command=new Command($commandArray);

$dispatcher=new Dispatcher($command);
$dispatcher->dispatch();

?>
