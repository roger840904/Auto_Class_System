<?php session_start();
require_once("./globefunction.php");
require_once("./mysql_connect.inc.php");

	show_popup_alert(); /* 自訂提醒視窗 */

	//將session清空
	session_unset();
	
	$account  = addslashes($_POST['account']);
	$password = addslashes($_POST['password']);
	
	if($account=="")
	{	?>
		<script>
			popup_modal_alert("error","請輸入帳號!","javascript: history.back()");
		</script>
		<?php
	}
	
	elseif($password=="")
	{	?>
		<script>
			popup_modal_alert("error","請輸入密碼!","javascript: history.back()");
		</script>
		<?php
	} 
	
	elseif(mysql_num_rows(mysql_query("select * from admin_info where account='$account' and password='$password'"))==0)
	{	?>
		<script>
			popup_modal_alert("error","帳號或密碼輸入錯誤!","javascript: history.back()");
		</script>
		<?php
	}
	
	else
	{
		$list=mysql_fetch_array(mysql_query("select * from admin_info where account='$account' and password='$password'"));
		
		// 防止user未經登入動作，直接複製網址。
		$_SESSION['aid']      = $list['aid'];
		$_SESSION['account']  = $list['account'];
		$_SESSION['email']    = $list['email'];
		?>
		<script language="JavaScript">
			location.href="./admin/surveymanage.php";
		</script>  
		<?php
	} 
?>
