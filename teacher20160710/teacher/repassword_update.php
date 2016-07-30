<?php session_start();
require_once("./globefunction.php");
require_once("./mysql_connect.inc.php");

	show_popup_alert(); /* 自訂提醒視窗 */

	$email=$_POST['email'];
	
	if($email=="")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「E-mail」!","javascript: history.back()");
		</script>
		<?php
		die();
	}
	
	elseif (preg_match('/^([.a-zA-Z0-9_]+)@([a-zA-Z0-9]+).([.a-zA-Z0-9]+)$/i', $email) == false) 
	{	?>
		<script>
			popup_modal_alert("error","「E-mail」格式錯誤!<br>請再次確認 !","javascript: history.back()");
		</script>
		<?php
		die();
	}
	
	else
	{
		$password = substr(md5(rand()),0,8);  
		/*rand() 產生亂數，md5() 變成32位元的字串，substr() 切割字串(切出字串一部分作為亂數密碼)
			切割字串方法_substr( $string_欲切割字串 , $start_開始擷取位置 , $length_欲擷取字串長度 )  */
		
		/* 將新密碼更新至資料庫中 */
		$sql_admin = " update admin_info set password =('".mysql_real_escape_string($password)."') where email='$email' ";	
		mysql_query($sql_admin);
		
		
		  
		/* 寄信 */
		// 一次查多張表
		$list = mysql_fetch_array(mysql_query(" select * from admin_info where (email='$email') "));
		$email_message = "彌陀國小排課系統管理者您好。\n您的帳號為：".mysql_real_escape_string($list['account'])
						."\n您的新密碼：".mysql_real_escape_string($list['password']);

		$to      = $list['email'];
		$subject = ' 高雄市彌陀國小排課系統 忘記密碼 ';
		$subject = "=?UTF-8?B?" .base64_encode($subject) . "?=";
		$message = $email_message; // E-mail信件內容
		$headers = 'From:' .mysql_real_escape_string('nemocandy5@gmail.com') ."\r\n" .
		'Reply-To:' .mysql_real_escape_string('nemocandy5@gmail.com') ."\r\n" .
		'X-Mailer: PHP/' .phpversion();
		
		if (mail("$to", "$subject", "$message", "$headers")):
			?>
			 <script>
				popup_modal_alert("success","送出成功!<br>請至您的信箱收信!","./login.php");
			 </script>
			 <?php
		
		else:
			?>
			 <script>
				popup_modal_alert("error","帳號錯誤，無法寄送E-mail !","javascript: history.back()");
			 </script>
			 <?php
		endif;
	}
?>