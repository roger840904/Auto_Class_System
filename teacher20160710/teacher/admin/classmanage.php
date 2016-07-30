<!DOCTYPE html>
<?php session_start();
require_once("../globefunction.php");
require_once("../mysql_connect.inc.php");
require_once("./judge_login.php");
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
				<input type="button" value="確認送出" class="btnBlue" onclick="popup_modal_submit('您確定要送出嗎？')" />
				<!-- 自訂 提醒視窗 -->
				<?php show_popup_model_admin();  /* globefunction.php */ ?>
			</form>
			<br/><br/><br/><br/>
			
			<font style="color:#5500BB; font-size:36px;">
				<b>選擇班級導師</b>
			</font>
			<br/><br/>
			<form id="teachermanage" name="teachermanage" method="POST" action="">
				<table style="width:80%; margin:0 auto;">
					<?php
					$grade = array("一年級","二年級","三年級","四年級","五年級","六年級");
					
					$teacherName = '<option id="無" value="無">---尚未選擇---</option>';
					$resultName = mysql_query("SELECT * FROM teacher_info WHERE jobTitle LIKE '%級任教師%'");
					while($listName = mysql_fetch_array($resultName))
					{
						$teacherName .= '<option id="'.$listName['tid'].'">'.$listName['name'].'</option>';
					}
					?>
					<script>
						var k = 0;
					</script>
					<?php
					for($i=1; $i<=6; $i++)
					{
						$resultClass = mysql_query("SELECT * FROM class_info WHERE gradeNumber='".$i."'");
						if($i%3==1)	echo "<tr>";
						?>
							<td style="padding:20px 2%; vertical-align:text-top;">
								<table border="1" id="t01">
									<tr>
										<th colspan="2" ><?php echo $grade[($i-1)]; ?></th>
									</tr>
									<?php
									while($listClass = mysql_fetch_array($resultClass))
									{
										$resultTeacher = mysql_query("SELECT * FROM class_teacher_info WHERE className='".$listClass['className']."'");
										$listTeacher = mysql_fetch_array($resultTeacher);
										
										$resultOrder = mysql_query("SELECT * FROM teacher_info WHERE (jobTitle LIKE '%級任教師%') and (tid <= ".$listTeacher['classTeacher'].")");
										$numOrder = mysql_num_rows($resultOrder);
										?>
										<tr>
											<td width="40%"><?php echo $listClass['className']; ?></td>
											<td width="60%">
												<select id="<?php echo $listClass['className']; ?>" name="teacherName" class="add">
													<?php echo $teacherName; ?>
												</select>
											</td>
											<script>
												var teacher = "<?php echo $listTeacher['classTeacher']; ?>";
												var numOrder = "<?php echo $numOrder; ?>";
												if(teacher != "")
													document.getElementsByClassName("add")[k].getElementsByTagName('option')[numOrder].selected = true;
												k++;
											</script>
										</tr>
										<?php
									}
									?>
								</table>
							</td>
						<?php
						if($i%3==0)	echo "</tr>";
					}
					?>
				</table>
				<input type="button" value="確認送出" class="btnBlue" onclick="popup_modal_submit('您確定要送出嗎？')" />
			</form>
		</div>
	</div>
	
	<!-- jQuery：自訂提醒視窗 -->
	<script type="text/javascript" src="../popup_window/jquery.min.js"></script>
	<script type="text/javascript" src="../popup_window/jquery.reveal.js"></script>
	<?php
	popup_model_href_javascript();					/* globefunction.php 純粹跳頁的時候 */
	popup_model_submit_javascript("classmanage");	/* globefunction.php 有form的時候 */
	?>
</body>
</html>