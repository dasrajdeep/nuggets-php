<?php namespace nuggets; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo Config::read('app_title'); ?></title>
    <?php
        $script='<script type="text/javascript" src="%s"></script>';
        $effects="jquery.effects.";
        $uri=Engine::getHostURL();
        echo sprintf($script,$uri.Registry::getPath("jquery"));
        echo sprintf($script,$uri.Registry::getPath("base64"));
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."core.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."fade.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."transfer.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."highlight.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."pulsate.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."blind.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."slide.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."drop.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."clip.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."fold.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."shake.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."explode.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."bounce.js");
        echo sprintf($script,$uri.Registry::getPath("jqueryui").$effects."scale.js");
        echo sprintf($script,$uri.Registry::getPath("scriptlib")."default.js");
    ?>
    <?php
        foreach($styles as $s) echo sprintf('<link rel="stylesheet" href="%s" />',$s);
		foreach($scripts as $s) echo sprintf('<script type="text/javascript" src="%s"></script>',$s);
    ?>
</head>

<body>
    <?php require_once($page_content); ?>
    <footer align="center"><?php echo Config::read('app_footer'); ?></footer>
</body>
</html>