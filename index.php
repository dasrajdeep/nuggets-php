<?php   
    require_once 'boot/bootstrap.php';

    $commandArray=array_values($requestURI);
    $command=new Command($commandArray);

    $dispatcher=new Dispatcher($command);
    $dispatcher->dispatch();
?>