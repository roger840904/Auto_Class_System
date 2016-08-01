<?php
	require_once("../mysql_connect.inc.php");
	
	$oldValue='';
	if(!isset($_POST['oldValue'])) {
		$oldValue=$_POST['oldValue'];
	}
	//TODO: post
	$result=mysql_query("SELECT * FROM subject WHERE `subjectName`='".$oldValue."'");
?>