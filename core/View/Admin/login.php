<style>
	#login_box {
		text-align:center;
		border:none;
		padding:5px;
		height:40%;
		width:40%;
		position:absolute;
		top:30%;
		left:30%;
	}
</style>
<h1 align="center">NUGGETS APPLICATION FRAMEWORK</h1>
<hr/>
<h2 align="center">ADMIN LOGIN</h2>
<div id="login_box">
	<form action="adminlogin" method="post">
		<table align="center">
			<tr>
				<th>Username</th><td><input type="text" name="username" /></td>
			</tr>
			<tr>
				<th>Password</th><td><input type="password" name="password" /></td>
			</tr>
		</table>
		<input type="submit" value="Login" />
	</form>
</div>
