<?php
	require_once('../mysql_connect.inc.php');
	
	if(mysql_query("UPDATE teacher_info SET `".$_POST['dataCol']."`='".$_POST['value']."' WHERE tid=".$_POST['dataRow']))
	{
		echo 'success';
	}
	else
	{
		echo 'fail';
	}
	
	if($_POST['dataCol']=='realClass') {
		mysql_query("UPDATE survey SET `totalClass`=`survey`.exceedClass+".$_POST['value']." WHERE tid=".$_POST['dataRow']);
	}
?>