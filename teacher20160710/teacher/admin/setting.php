<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();
require_once("../globefunction.php");
require_once("../mysql_connect.inc.php");
require_once("./judge_login.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>修改帳密</title>
	<link rel="stylesheet" type="text/css" href="../popup_window/styles_popup_window.css">
	<link rel="stylesheet" type="text/css" href="../css/styles_main.css"/>
	<link rel="stylesheet" type="text/css" href="../css/styles_login.css"/>
</head>

<body>
	<div id="menu">
		<?php menu();  /* globefunction.php */ ?>
	</div>
	
	<!-- 中間區塊 middle -->
	<div id="middle">
		
		<!-- Main content -->
		<div id="main">
			<?php 
			$sql = "select * from admin_info where aid='$_SESSION[aid]'";
			$result = mysql_query($sql);
			$list = mysql_fetch_array($result);
			?>
		
			<form id="modify_info" name="modify_info" method="post" enctype="multipart/form-data" action="setting_update.php">
				<fieldset class="fieldset_class">
					<legend class="legend_class"> &nbsp修改帳密&nbsp </legend>
					
					<table class="register_table">
						<tr>
							<th colspan="2" style="text-align:center; font-weight:normal; color:#A500CC;">
								(<span class="required">*</span>為必填項目)
							</th>
						</tr>
						<tr>
							<th width="30%"><span class="required">*</span>帳號</th>
							<td width="70%"><input type="text" name="account" value="<?php echo $list[account]; ?>"></td>
						</tr>
						<tr>
							<th><span class="required">*</span>密碼</th>
							<td><input type="password" name="password" value="<?php echo $list[password]; ?>"></td>
						</tr>
						<tr>
							<th><span class="required">*</span>確認密碼</th>
							<td><input type="password" name="check_password" value="<?php echo $list[password]; ?>"></td>
						</tr>
						<tr>
							<th width="30%"><span class="required">*</span>E-mail</th>
							<td width="70%"><input type="text" name="email" value="<?php echo $list[email]; ?>"></td>
						</tr>
					</table>
				</fieldset>
				
				<div style="margin-bottom:50px;">
					<input type="button" value="回上一頁" class="btnBlue" onclick="popup_modal_href('您確定要回上一頁嗎？','surveymanage.php')" />
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<input type="button" value="確認送出" class="btnBlue" onclick="popup_modal_submit('您確定要送出嗎？')"/>
				</div>
				
				<!-- 自訂 提醒視窗 -->
				<?php show_popup_model_admin();  /* globefunction.php */ ?>
			</form>
		</div>
	</div>
	
	<!-- jQuery：自訂提醒視窗 -->
	<script type="text/javascript" src="../popup_window/jquery.min.js"></script>
	<script type="text/javascript" src="../popup_window/jquery.reveal.js"></script>
	<?php
	popup_model_href_javascript();					/* globefunction.php 純粹跳頁的時候 */
	popup_model_submit_javascript("modify_info");	/* globefunction.php 有form的時候 */
	?>
</body>
</html>
