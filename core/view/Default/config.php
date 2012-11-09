<div id="header" align="center">
    <h1>Nuggets Application Framework</h1>
</div>
<div align="center">
    <h2>Engine Configuration</h2>
    <div>Click <?php echo sprintf('<a href="%s">here</a>',Engine::getHostURL()."master") ?> to go to the engine master page.</div>
</div>
<div align="center"><img src="<?php echo Engine::getHostURL(); ?>core/view/Default/images/icon_settings.png" /></div>
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
        echo sprintf($format,"Site Header",HTMLHelper::getInput("text", "header",$site_data["header"]));
        echo sprintf($format,"Site Caption",HTMLHelper::getInput("text", "caption",$site_data["caption"]));
        echo sprintf($format,"Site Footer",HTMLHelper::getInput("text", "footer",$site_data["footer"]));
        ?>
        </table>
    </div>
    <div id="notification"></div>
    <div class="loader" id="loader_config_save">
        <img src="<?php echo Engine::getHostURL(); ?>core/view/Default/images/loader-1.gif" />
    </div>
    <div>
        <?php
        echo HTMLHelper::getInput("button", "save","Save Configuration");
        ?>
    </div>
</div>