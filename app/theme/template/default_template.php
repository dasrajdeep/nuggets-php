<?php 
if(Session::isRunning()) {
    echo '
    <div id="navigation_bar">
        <table width="100%" height="100%" cellspacing="10px"><tr>';
            echo sprintf('
                <td>%s</td>
                <td align="right"><a href="%s">logout</a></td>
        </tr></table>
    </div>
    ',Session::getVar('username'),Engine::getHostURL().'logout');
}
?>
<div style="height: 40px;"></div>
<?php require_once $template_body; ?>