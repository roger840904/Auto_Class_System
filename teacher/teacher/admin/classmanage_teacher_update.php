<?php session_start();
require_once("../globefunction.php");
require_once("../mysql_connect.inc.php");
require_once("./judge_login.php");

	show_popup_alert_admin(); /* 自訂提醒視窗 */
	
	$teacher = $_POST["teacherName"];
	$i = 0;
	$resultClass = mysql_query("SELECT * FROM `class_info`");
	while($listClass = mysql_fetch_array($resultClass))
	{
		if($teacher[$i]=='無'){}
		else
		{
			$resultTeacher = mysql_query("SELECT * FROM `class_teacher_info` WHERE className='".$listClass['className']."'");
			$row = mysql_num_rows($resultTeacher);
			if($row == 0)
			{
				$sql = "INSERT INTO `class_teacher_info`(`className`, `classTeacher`) VALUES('".$listClass['className']."','".$teacher[$i]."')";
				if(mysql_query($sql))
				{	?>
					<script>
						popup_modal_alert("success","送出成功!","classmanage.php");
					</script>
					<?php
				}
				else
				{	?>
					<script>
						popup_modal_alert("error","送出失敗!","javascript: history.back()");
					</script>
					<?php
				}
			}
			else
			{
				$sql2 = "UPDATE `class_teacher_info` SET `classTeacher` = '".$teacher[$i]."' WHERE `className` = '".$listClass['className']."'";
				if(mysql_query($sql2))
				{	?>
					<script>
						popup_modal_alert("success","送出成功!","classmanage.php");
					</script>
					<?php
				}
				else
				{	?>
					<script>
						popup_modal_alert("error","送出失敗!","javascript: history.back()");
					</script>
					<?php
				}
			}
		}
		$i++;
	}
?>