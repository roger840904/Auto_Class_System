<?php session_start();
require_once("../globefunction.php");
require_once("../mysql_connect.inc.php");
require_once("./judge_login.php");

	show_popup_alert_admin(); /* 自訂提醒視窗 */
	
	$grade1		= addslashes($_POST["grade1"]);
	$grade2		= addslashes($_POST["grade2"]);
	$grade3		= addslashes($_POST["grade3"]);
	$grade4		= addslashes($_POST["grade4"]);
	$grade5		= addslashes($_POST["grade5"]);
	$grade6		= addslashes($_POST["grade6"]);
	
	if($grade1 == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「一年級班級數」!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if($grade2 == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「二年級班級數」!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if($grade3 == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「三年級班級數」!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if($grade4 == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「四年級班級數」!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if($grade5 == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「五年級班級數」!","javascript: history.back()");
		</script>
		<?php
	}
	
	else if($grade6 == "")
	{	?>
		<script>
			popup_modal_alert("error","請輸入「六年級班級數」!","javascript: history.back()");
		</script>
		<?php
	}
	else
	{
		if (isset($grade1) && isset($grade2) && isset($grade3) && isset($grade4) && isset($grade5) && isset($grade6))
		{
			$sqldel="TRUNCATE `class_info`";
			mysql_query($sqldel);
		
			$sqldel2="TRUNCATE `class_teacher_info`";
			mysql_query($sqldel2);
		
			for($i=1;$i<=6;$i++)
			{
				$sql="SELECT * FROM `grade_info` WHERE `gradeNumber` = ".$i;	
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
				if($row<1)
				{
					$sql2="INSERT INTO `grade_info` VALUES('".$i."','".$_POST['grade'.$i]."')";
					mysql_query($sql2);
					
					for($j=1;$j<=$_POST['grade'.$i];$j++)
					{
						$sql4="INSERT INTO `class_info` VALUES('','".$i."0".$j."','".$i."')";
						mysql_query($sql4);
					}
				}
				else
				{
					$sql3="UPDATE `grade_info` SET `gradeClassNum` = ". $_POST['grade'.$i] ." where `gradeNumber` = ".$i;
					mysql_query($sql3);
				
					for($j=1;$j<=$_POST['grade'.$i];$j++)
					{
						$sql5="INSERT INTO `class_info` VALUES('','".$i."0".$j."','".$i."')";
						mysql_query($sql5);
					}
				}
			}
			?>
			<script>
				popup_modal_alert("success","送出成功!","surveymanage.php");
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
?>