<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();
require_once("./globefunction.php");
require_once("./mysql_connect.inc.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>忘記密碼</title>
	<link rel="stylesheet" type="text/css" href="popup_window/styles_popup_window.css">
	<link rel="stylesheet" type="text/css" href="css/styles_main.css"/>
	<link rel="stylesheet" type="text/css" href="css/styles_login.css"/>
</head>

<body>
	<!-- 上方區塊 header -->
	<div style="text-align:center;">
		<img src="image/header.jpg" style="width:80%;height:230px;">
	</div>
	
	<!-- 中間區塊 middle -->
	<div style="top:250px;">
		<!-- Main content -->
		<div id="main">
			<form id="repassword" name="repassword" method="post" enctype="multipart/form-data" action="repassword_update.php">
				<fieldset class="fieldset_class">
					<legend class="legend_class"> &nbsp忘記密碼&nbsp </legend>
					
					<table class="register_table">
						<tr>
							<th colspan="2" style="text-align:center; font-weight:normal; color:#A500CC;">
								請填寫E-mail，系統將發一組新密碼至您的信箱!
							</th>
						</tr>
						<tr>
							<th width="30%">E-mail</th>
							<td width="70%"><input type="text" name="email" placeholder="請輸入E-mail"></td>
						</tr>
					</table>
				</fieldset>
				
				<div style="margin-bottom:50px;">
					<input type="button" value="回上一頁" class="btnBlue" onclick="popup_modal_href('您確定要回上一頁嗎？','./login.php')" />
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<input type="button" value="確認送出" class="btnBlue" onclick="popup_modal_submit('您確定要送出嗎？')"/>
				</div>
				
				<!-- 自訂 提醒視窗 -->
				<?php show_popup_model();  /* globefunction.php */ ?>
			</form>
		</div>
	</div>
	
	<!-- jQuery：自訂提醒視窗 -->
	<script type="text/javascript" src="popup_window/jquery.min.js"></script>
	<script type="text/javascript" src="popup_window/jquery.reveal.js"></script>
	<?php
	popup_model_href_javascript();					/* globefunction.php 純粹跳頁的時候 */
	popup_model_submit_javascript("repassword");	/* globefunction.php 有form的時候 */
	?>
</body>
</html>