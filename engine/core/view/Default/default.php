<div id="header" align="center">
    <h1>Nuggets Application Framework</h1>
</div>
<?php
$default_path='engine/core/view/Default/';
if(Engine::engineError()) {
    $icon=$default_path."images/icon_remove.png";
    $message="Oops! It seems that the engine is not properly configured.";
    echo sprintf('<div id="msg0"><img src="%s" /><span>%s</span></div>',$icon,$message);
    $uri=Engine::getHostURL()."config";
    echo sprintf('<div>Click <a href="%s">here</a> to configure the engine.</div>',$uri);
    $errors=Engine::getErrors();
    foreach($errors as $e) {
        $errmsg=Engine::getError($e);
        $icon=$default_path."images/icon_warning.png";
        echo sprintf('<div id="msg1"><img src="%s" /><span>%s</span></div>',$icon,$errmsg);
    }
}
else {
    $icon=$default_path."images/icon_tick.png";
    $message="Engine is properly configured";
    echo sprintf('<div align="center" id="msg0"><img src="%s" /><span>%s</span></div>',$icon,$message);
}
?>