<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();
require_once("../globefunction.php");

	if($_SESSION['aid'] == null)
	{
		show_popup_alert_admin(); /* 自訂提醒視窗 */?>
		<script>
			popup_modal_alert("error","請先登入會員，<br>才可以使用本頁面服務！","../login.php");
		</script><?php
		die('');
	}
?>