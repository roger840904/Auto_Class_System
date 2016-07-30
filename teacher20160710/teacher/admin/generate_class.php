<?php
	require_once('../mysql_connect.inc.php');
	require_once('generate_class_lib.php');
	
	
    clearTable('class_time_info');
	
	for($p=1;$p<=6;$p++){
		$result2=mysql_query("SELECT `gradeClassNum` FROM `grade_info` WHERE `gradeNumber` = ".$p);
		$row2=mysql_fetch_row($result2);
		for($q=1;$q<=$row2[0];$q++){
			$classList=getPEClass($p, $q);
			printClassList($classList, $p, $q);
		}
	}
?>