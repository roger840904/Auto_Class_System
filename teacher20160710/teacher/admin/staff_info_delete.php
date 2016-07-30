<?php
	require_once('../mysql_connect.inc.php');
	
	if(mysql_query("DELETE FROM teacher_info WHERE tid='".$_POST['tid']."'"))
	{
		echo 'success';
	}
	else
	{
		echo 'fail';
	}
?>