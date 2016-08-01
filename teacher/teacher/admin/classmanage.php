<!DOCTYPE html>
<?php session_start();
require_once("../globefunction.php");
require_once("../mysql_connect.inc.php");
require_once("./judge_login.php");

function tidToTeacher($className) {
	$resultClassTeacherInfo=mysql_query("SELECT * FROM class_teacher_info WHERE className='".$className."'");
	$rowClassTeacherInfo=mysql_fetch_array($resultClassTeacherInfo);
	$selectedTeacher='null';
	if($rowClassTeacherInfo['teacherName']!='null') {
		$resultTeacherInfo=mysql_query("SELECT * FROM teacher_info WHERE tid='".$rowClassTeacherInfo['classTeacher']."'");
		$selectedTeacher=mysql_fetch_array($resultTeacherInfo);
	}
	
	return $selectedTeacher;
}
?>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>班級管理</title>
	<link rel="stylesheet" type="text/css" href="../popup_window/styles_popup_window.css">
	<link rel="stylesheet" type="text/css" href="../css/styles_main.css"/>
	<link rel="stylesheet" type="text/css" href="../css/styles_login.css"/>
</head>
	
<body>
	<div id="menu">
		<?php menu();  /* globefunction.php */ ?>
	</div>
	
	<div style="text-align:center;">
		<font style="font-size:52px;">
			<b>班級管理</b>
		</font>
	</div>
	
	<div style="border:2px #ccc solid; padding:20px;">
		<div style="text-align:center;">
			<br/>
			<font style="color:#5500BB; font-size:36px;">
				<b>設定班級數目</b>
			</font>
			<br/><br/><br/>
			<form id="classmanage" name="classmanage" method="POST" action="classmanage_insert.php">
				一年級：<input name="grade1" type="text" style="padding:5px 10px;" />、
				二年級：<input name="grade2" type="text" style="padding:5px 10px;" />、
				三年級：<input name="grade3" type="text" style="padding:5px 10px;" />
				<br/><br/><br/>
				四年級：<input name="grade4" type="text" style="padding:5px 10px;" />、
				五年級：<input name="grade5" type="text" style="padding:5px 10px;" />、
				六年級：<input name="grade6" type="text" style="padding:5px 10px;" />
				<br/><br/><br/>
				<input type="button" value="回上一頁" class="btnBlue" onclick="popup_modal_href('您確定要回上一頁嗎？','surveymanage.php')" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="確認送出" class="btnBlue" onclick="popup_modal_submit('您確定要送出嗎？','classmanage')" />
				<!-- 自訂 提醒視窗 -->
				<?php show_popup_model_admin();  /* globefunction.php */ ?>
			</form>
			<br/><br/><br/><br/>
			
			<font style="color:#5500BB; font-size:36px;">
				<b>選擇班級導師</b>
			</font>
			<br/><br/>
			<form id="teachermanage" name="teachermanage" method="POST" action="class_teacher_info_update.php">
				<?php
					for($i=0; $i<2; $i++) {
						echo '<table style="width:80%; margin:0 auto;">';
						echo '<tr>';
						for($j=0; $j<3; $j++) {
							echo '<td style="padding:20px 2%; vertical-align:text-top;">';
							
							echo '<table border="1" id="t01">';
							$gradeNumber=$i*3+($j+1);
							echo '<tr><th colspan="2">'.$gradeNumber.'年級</th></tr>';
							$resultClassInfo=mysql_query("SELECT * FROM class_info WHERE gradeNumber=".$gradeNumber);
							while($row=mysql_fetch_array($resultClassInfo)) {
								$selectedTeacher=tidToTeacher($row['className']);
								
								echo '<tr>';
								echo '<td width="40%">'.$row['className'].'</td>';
								echo '<td width="60%">';
								echo '<select class="add" name="teacher['.$row['className'].'][teacherName]">';
								
								$resultTeacher=mysql_query("SELECT * FROM teacher_info");
								echo '<option value="無">---尚未選擇---</option>';
								while($row2=mysql_fetch_array($resultTeacher)) {
									if($row2['name']==$selectedTeacher['name']) {
										echo '<option selected="selected">'.$row2['name'].'</option>';
									} else {
										echo '<option>'.$row2['name'].'</option>';
									}
								}
								
								echo '</select></td>';
								echo '</tr>';
							}
							echo '</table>';
							
							echo '</td>';
						}
						echo '</tr>';
						echo '</table>';
					}
				?>
				<br/><br/><br/>
				<input type="button" value="回上一頁" class="btnBlue" onclick="popup_modal_href('您確定要回上一頁嗎？','surveymanage.php')" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="確認送出" class="btnBlue" onclick="popup_modal_submit('您確定要送出嗎？','teachermanage')" />
				<!-- 自訂 提醒視窗 -->
				<?php show_popup_model_admin();  /* globefunction.php */ ?>
			</form>
		</div>
	</div>
	
	<!-- jQuery：自訂提醒視窗 -->
	<script type="text/javascript" src="../popup_window/jquery.min.js"></script>
	<script type="text/javascript" src="../popup_window/jquery.reveal.js"></script>
	<?php
	popup_model_href_javascript();		/* globefunction.php 純粹跳頁的時候 */
	popup_model_submit_javascript2();	/* globefunction.php 有form的時候 */
	?>
</body>
</html>