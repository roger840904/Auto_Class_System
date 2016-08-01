<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();
require_once("../globefunction.php");
require_once("../mysql_connect.inc.php");
require_once("./judge_login.php");

	show_popup_alert_admin(); /* 自訂提醒視窗 */
	
	$account		= addslashes($_POST['account']);
	$password		= addslashes($_POST['password']);
	$check_password	= addslashes($_POST['check_password']);
	$email	        = addslashes($_POST['email']);
	
	if($account == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「帳號」!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if($password == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「密碼」!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if($check_password == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「確認密碼」!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if(strlen($password) < 4 || strlen($password) > 12 || 
			strlen($check_password) < 4 || strlen($check_password) > 12 || 
			preg_match( '/^[0-9a-zA-Z_]+$/u',$password) == false
			|| preg_match( '/^[0-9a-zA-Z_]+$/u',$check_password) == false) 
	{	?>
		<script>
			popup_modal_alert("error","「密碼」含有錯誤字元! 請輸入<br>4~12位數的英文、數字或底線!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if($password != $check_password)
	{	?>
		<script>
			popup_modal_alert("error","「密碼」不一致!<br>請重新輸入!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if(preg_match('/^([.a-zA-Z0-9_]+)@([a-zA-Z0-9]+).([.a-zA-Z0-9]+)$/i',$email) == false) 
	{	?>
		<script>
			popup_modal_alert("error","「E-mail」格式錯誤!<br>請輸入E-mail !","javascript: history.back()");
		</script>
		<?php
	}
	
	else
	{
		// update 更新資料庫
		$sql_admin = "update admin_info set 
						account='".mysql_real_escape_string($account)."',
						password='".mysql_real_escape_string($password)."',
						email='".mysql_real_escape_string($email)."'
					where aid = '$_SESSION[aid]'";
		
		if(mysql_query($sql_admin))
		{	?>
			<script>
				popup_modal_alert("success","修改成功!","surveymanage.php");
			</script>
			<?php
		}
		else
		{	?>
			<script>
				popup_modal_alert("error","修改失敗!","javascript: history.back()");
			</script>
			<?php
		}
	}
?>
