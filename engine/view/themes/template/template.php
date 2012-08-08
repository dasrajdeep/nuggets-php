<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo Config::read("site", "title"); ?></title>
    <?php
        $script='<script type="text/javascript" src="%s"></script>';
        $effects="jquery.effects.";
        $uri=Engine::getHostURL();
        echo sprintf($script,$uri.Engine::path("jquery"));
        echo sprintf($script,$uri.Engine::path("base64"));
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."core.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."fade.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."transfer.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."highlight.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."pulsate.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."blind.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."slide.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."drop.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."clip.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."fold.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."shake.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."explode.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."bounce.js");
        echo sprintf($script,$uri.Engine::path("jqueryui").$effects."scale.js");
        echo sprintf($script,$uri.Engine::path("scriptlib")."default.js");
    ?>
    <?php
        $this->loadHeaders();
    ?>
    <script type="text/javascript">
        var domain='<?php echo Engine::getHostURL(); ?>';
    </script>
</head>

<body>
    <?php
        require_once $this->getViewPath().$file;
    ?>
    <div class="separator"></div>
    <h5 id="footer" align="center"><?php echo Config::read("site", "footer"); ?></h5>
</body>
</html>