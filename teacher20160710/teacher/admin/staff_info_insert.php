<?php
	require_once('../mysql_connect.inc.php');
	
	$realClass = $_POST['jobClass'] - $_POST['subClass'];
	
	if($realClass>0)
	{
		$sql = "INSERT INTO teacher_info(`name`,`jobTitle`,`limit`,`jobClass`,`subClass`,`realClass`) 
				VALUES ('".$_POST['name']."',
						'".$_POST['jobTitle']."',
						'".$_POST['limit']."',
						".$_POST['jobClass'].",
						".$_POST['subClass'].",
						$realClass)";
		if(mysql_query($sql))
		{
			echo '輸入成功';
		}
		else
		{
			echo '輸入失敗';
		}
	}
	header('Location: staffmanage.php');
?>