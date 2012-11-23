<?php 
/**
 * This file contains the HTML template for rendering a view.
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo Config::read('app_title'); ?></title>
    <?php
        $script='<script type="text/javascript" src="%s"></script>';
        $uri=Engine::getHostURL();
		
		$libPath=Registry::getPath('scriptlib');
        echo sprintf($script,$uri.$libPath.'jquery.js');
		echo sprintf($script,$uri.$libPath.'base64.js');
		echo sprintf($script,$uri.$libPath.'utility.js');
		echo sprintf($script,$uri.$libPath.'appearance.js');
		
		$effects="jquery.effects.";
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
    ?>
	<script type="text/javascript">var hosturl='<?php echo $uri; ?>';</script>
    <?php
        foreach($styles as $s) echo sprintf('<link rel="stylesheet" href="%s" />',$uri.$s);
		foreach($scripts as $s) echo sprintf('<script type="text/javascript" src="%s"></script>',$uri.$s);
    ?>
</head>

<body>
    <?php require_once($page_content); ?>
    <div id="footer">
		<hr/>
		<footer align="center"><?php echo Config::read('app_footer'); ?></footer>
    </div>
</body>
</html>
