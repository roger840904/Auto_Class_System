<html>
<?php session_start();
require_once("./mysql_connect.inc.php");
?>
<head>
	<meta charset="UTF-8">
	<title>管理者登入</title>
	<br><br><br><br>
	<style>
		.header {
		  text-align: center;
		}
		body{
			background-image:url("image/background.jpg");
		}
		
		.btnBlue {
			-moz-box-shadow:inset 0px 1px 0px 0px #97c4fe;
			-webkit-box-shadow:inset 0px 1px 0px 0px #97c4fe;
			box-shadow:inset 0px 1px 0px 0px #97c4fe;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #3d94f6), color-stop(1, #1e62d0));
			background:-moz-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
			background:-webkit-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
			background:-o-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
			background:-ms-linear-gradient(top, #3d94f6 5%, #1e62d0 100%);
			background:linear-gradient(to bottom, #3d94f6 5%, #1e62d0 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d94f6', endColorstr='#1e62d0',GradientType=0);
			background-color:#3d94f6;
			-moz-border-radius:6px;
			-webkit-border-radius:6px;
			border-radius:6px;
			border:1px solid #337fed;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:20px;
			font-weight:bold;
			padding:10px 20px;
			text-align:center;
			text-decoration:none;
			text-shadow:0px 1px 0px #1570cd;
		}
		.btnBlue:hover {
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #1e62d0), color-stop(1, #3d94f6));
			background:-moz-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
			background:-webkit-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
			background:-o-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
			background:-ms-linear-gradient(top, #1e62d0 5%, #3d94f6 100%);
			background:linear-gradient(to bottom, #1e62d0 5%, #3d94f6 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0', endColorstr='#3d94f6',GradientType=0);
			background-color:#1e62d0;
			text-decoration:underline;
		}
		.btnBlue:active {
			position:relative;
			top:1px;
			text-decoration:underline;
		}
	</style>
</head>

<body>
	<div class="header">
		<font style="font-size:52px;"> <b>管理者登入</b></font>
		<br><br>
		<hr>
	</div>

	<div class="header">
		<br>
		<br>
		<form id="login" name="login" method="post" enctype="multipart/form-data" action="./input.php">
			<h2>
				<font>帳號：</font>
				<input name="account" id="account" placeholder="Account" type="text" style="padding:5px 10px;">
			</h2>
			<br>
			<h2>
				<font>密碼：</font>
				<input name="password" id="password" placeholder="Password" type="password" style="padding:5px 10px;">
			</h2>
			<p>忘記密碼? &nbsp;<a href="repassword.php">請點我!</a></p>
			<br><br><br>
			<a type="button" onclick="location.href='index.php'" class="btnBlue">回首頁</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btnBlue">登入</button>
		</form>
	</div>
</body>
</html>