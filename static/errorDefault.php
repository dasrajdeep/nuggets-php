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
		.error {
			font-weight:bold;
			background-color:#FFC5BF;
			color:#cc0000;
			border-radius:5px;
			padding:5px;
			margin:5px;
		}
	</style>
</head>

<body>
	<div id="header" align="center">
		<div style="height:50px"></div>
		<h1>NUGGETS APPLICATION FRAMEWORK</h1>
		<hr/>
	</div>
	<div>
		<img src="static/images/icon_error.png" />
		<h2>AN ERROR OCCURED. NUGGETS COULD NOT CONTINUE.</h2>
	</div>
	<div class="error">
		<?php echo $msg; ?>
	</div>
	<footer align="center" style="margin:50px"><i>Copyright 2012 Rajdeep Das</i></footer>
</body>
</html>