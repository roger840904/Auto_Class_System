<?php
	require_once('../mysql_connect.inc.php');
	
	if(mysql_query("UPDATE survey SET `".$_POST['dataCol']."`='".$_POST['value']."' WHERE tid=".$_POST['dataRow']))
	{
		echo 'success';
	}
	else
	{
		echo 'fail';
	}
?>