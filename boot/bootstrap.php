<?php
    session_start();
    
    require_once 'boot/package_interpreter.php';
    require_once 'boot/engine_loader.php';
    
    import("nuggets.core.Command");
    import("nuggets.core.Dispatcher");
    
    $requestURI=explode('/',$_SERVER['REQUEST_URI']);
    $scriptName=explode('/',$_SERVER['SCRIPT_NAME']);

    for($i=0;$i<sizeof($scriptName);$i++) {
            if ($requestURI[$i]==$scriptName[$i]) unset($requestURI[$i]);
    }
?>