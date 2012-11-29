<?php
/**
 * This file contains the HTML for rendering a nuggets error page.
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nuggets Application Framework</title>
	<style>
		body {
			background-color:#1c5a85;
			color:#ebedee;
			font-family:arial,sans-seriff;
			text-align:center;
		}
		hr {
			color:#ebedee;
		}
		a {
			color:#ADD8E6;
			text-decoration:none;
		}
		a:hover {
			color:#FFC0CB;
		}
		
		.error {
			font-weight:bold;
			background-color:#FFC5BF;
			color:#cc0000;
			border-radius:5px;
			padding:5px;
			margin:5px;
		}
		.error tr {
			background-color:#FFC5BF;
		}
		.error th {
			background-color:#cc0000;
			color:#FFC5BF;
			border-radius:5px;
			padding:5px;
		}
		.error td {
			border:solid;
			border-width:1px;
			border-color:#cc0000;
			border-radius:5px;
			padding:5px;
		}
	</style>
</head>

<body>
	<div id="header" align="center">
		<div style="height:50px"></div>
		<h1><a href="http://dasrajdeep.github.com/nuggets-php">NUGGETS APPLICATION FRAMEWORK</a></h1>
		<hr/>
	</div>
	<div>
		<img src="static/images/icon_error.png" />
		<h2>NUGGETS CANNOT CONTINUE UNTIL THESE ISSUES ARE RESOLVED.</h2>
	</div>
	<div class="error">
		<table align="center">
			<tr><th>ERROR CODE</th><th>ERROR</th></tr>
			<?php
				foreach($errors as $e) echo sprintf('<tr><td>%s</td><td>%s</td></tr>',$e[0],$e[1]);
			?>
		</table>
	</div>
	<footer align="center" style="margin:50px"><i>Copyright 2012 <a href="http://dasrajdeep.github.com/nuggets-php">Nuggets</a> by Rajdeep Das</i></footer>
</body>
</html>
