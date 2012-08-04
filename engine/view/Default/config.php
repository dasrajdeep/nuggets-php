<div id="header" align="center">
    <h1>Nuggets Application Framework</h1>
</div>
<div align="center">
    <h2>Engine Configuration</h2>
    <div>Click <?php echo sprintf('<a href="%s">here</a>',Engine::getHostURL()."master") ?> to go to the engine master page.</div>
</div>
<div align="center"><?php echo HTMLHelper::getImage("Default/images/icon_settings.png"); ?></div>
<?php
$db_data=$this->getVar("database");
$site_data=$this->getVar("site");
?>
<div align="center">
    <div id="database_config">
        <h3>Database</h3>
        <table class="config_fields">
        <?php
        $format='<tr><td class="right_align">%s</td><td>%s</td></tr>';
        echo sprintf($format,"Host",HTMLHelper::getInput("text", "host",$db_data["host"]));
        echo sprintf($format,"Port",HTMLHelper::getInput("text", "port",$db_data["port"]));
        echo sprintf($format,"Username",HTMLHelper::getInput("text", "username",$db_data["username"]));
        echo sprintf($format,"Password",HTMLHelper::getInput("password", "password",$db_data["password"]));
        echo sprintf($format,"Database Name",HTMLHelper::getInput("text", "name",$db_data["name"]));
        echo sprintf($format,"Table Prefix",HTMLHelper::getInput("text", "prefix",$db_data["prefix"]));
        ?>
        </table>
    </div>
    <div id="site_config">
        <h3>Web Site</h3>
        <table class="config_fields">
        <?php
        echo sprintf($format,"Site Title",HTMLHelper::getInput("text", "title",$site_data["title"]));
        echo sprintf($format,"Site Caption",HTMLHelper::getInput("text", "domain",$site_data["caption"]));
        ?>
        </table>
    </div>
    <div id="notification"></div>
    <?php
    echo HTMLHelper::getLoader("Default/images/", "1", "loader_config_save");
    ?>
    <div>
        <?php
        echo HTMLHelper::getInput("button", "save","Save Configuration");
        ?>
    </div>
</div>