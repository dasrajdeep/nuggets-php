<h1 align="center">Nuggets-PHP Admin</h1>
<hr/>

<form name="admin_logout" action="adminlogout" style="text-align:center">
	<input type="button" value="Logout" onclick="document.admin_logout.submit()" />
</form>

<h2 align="center">LOGS</h2>

<div>
	<?php
		$files=$this->getVar('logfiles');
		$numFiles=count($files);
		$colSize=100/$numFiles-1;
		
		foreach($files as $file) {
			$info=pathinfo($file);
			echo '<div style="text-align:center;float:left;width="'.$colSize.'%"><b>'.$info['filename'].'</b><br/><pre>';
			print_r(file_get_contents($file));
			echo '</pre></div>';
		}
	?>
</div>
<div style="clear:both"></div>
