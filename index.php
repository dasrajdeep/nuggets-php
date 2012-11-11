<?php   
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