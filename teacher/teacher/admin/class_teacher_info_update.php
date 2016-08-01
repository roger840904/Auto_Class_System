<?php
	session_start();
	require_once('../mysql_connect.inc.php');
	require_once('./judge_login.php');
	
	mysql_query("TRUNCATE TABLE class_teacher_info");
	mysql_query("TRUNCATE TABLE course_info");
	$resultClassInfo=mysql_query("SELECT * FROM class_info");
	while($row=mysql_fetch_array($resultClassInfo)) {
		$teacherName=$_POST['teacher'][$row['className']]['teacherName'];
		if($teacherName=='無') {
			mysql_query("INSERT INTO class_teacher_info(`className`, `classTeacher`) VALUES ('".$row['className']."', 'null')");
		} else {
			$resultTeahcerName=mysql_query("SELECT * FROM teacher_info WHERE `name`='".$teacherName."'");
			$rowTeacherName=mysql_fetch_array($resultTeahcerName);
			mysql_query("INSERT INTO class_teacher_info(`className`, `classTeacher`) VALUES ('".$row['className']."', '".$rowTeacherName['tid']."')");
		}
		$sqlsuid = mysql_query("SELECT * FROM `grade_schema_info` WHERE `gradeNumber` = ". ROUND($row['className']/100,0));
		while($coursesuid = mysql_fetch_array($sqlsuid)){
			$sqlctid = mysql_query("SELECT * FROM `class_time_info` WHERE `subjectNum` = ". $coursesuid['subjectNum'] ." and `className` = ".$row['className']);
			while($coursectid = mysql_fetch_array($sqlctid)){
				mysql_query("INSERT INTO `course_info`( `cid`, `suid`, `tid`, `ctid`, `rid`) VALUES (". $row['className'] .",". $coursesuid['subjectNum'] .",". $rowTeacherName['tid'] .",". $coursectid['ctid'] .",". $row['className'] .")");			
			}
		}
	}			
	header('Location: classmanage.php');
?>