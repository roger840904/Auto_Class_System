<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
require_once("./globefunction.php");
require_once("./mysql_connect.inc.php");

show_popup_alert();  /* 自訂提醒視窗 globefunction.php */

$teacherName = $_POST['teacherName'];
$overtime    = $_POST['overtime'];
$overtimeNum = $_POST['overtimeNum'];

$subject=$_POST['subject'];
$hopeNumArray=['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二', '十三', '十四', '十五'];

if($teacherName=="")
{	?>
	<script>
		popup_modal_alert("error","請填寫「教師姓名」!","javascript: history.back()");
	</script>
	<?php
	die();
}
else
{
	if($overtime=="true" && $overtimeNum=="")
	{	?>
		<script>
			popup_modal_alert("error","請填寫「超鐘點節數」!","javascript: history.back()");
		</script>
		<?php
		die();
	}
	else 
	{
		$result = mysql_query("SELECT * FROM teacher_info WHERE name='$teacherName'");
		$list = mysql_fetch_array($result);
		
		if($overtime=="false")
			$overtimeNum = 0;
		$tid = $list['tid'];
		$totalClass = $list['jobClass'] + $overtimeNum;
		$realTotalClass = $list['realClass'] + $overtimeNum;
	}
}
?>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>彌陀國小線上排課系統─意願調查確認</title>
	<link rel="stylesheet" type="text/css" href="css/style_teacher.css"/>
	<link rel="stylesheet" type="text/css" href="popup_window/styles_popup_window.css">
</head>

<body>
	<div class="main">
		<?php include("teacherbutton.php"); ?>
		
		<div class="content" style="text-align:center;">
			<h1 style="color:#CC00EE;"><?php echo $teacherName; ?>老師</h1>
			<div class="showClass">
				<!-- 基本節數：<?php echo $list['jobClass']; ?>		<br/> -->
				<!-- 減課節數：<?php echo $list['subClass']; ?>		<br/> -->
				超鐘節數：<?php echo $overtimeNum; ?>	<br/>
				<!-- 總節數：<?php echo $totalClass; ?> -->
			</div>
			
			<table id="resultTable">
				<tr>
					<th colspan="2">意願科目</th>
				</tr>
				<?php
					for($i=0; $i<count($hopeNumArray); $i++) {
						echo '<tr>';
						echo '<td width="50%">意願'.$hopeNumArray[$i].'</td>';
						echo '<td>'.$subject[$i].'</td>';
						echo '</tr>';
					}
				?>
			</table>
			
			<form id="teachercheck" method="post" action="teachercheck_update.php">
				<input type="hidden" name="tid"			value="<?php echo $tid; ?>" />
				<input type="hidden" name="exceedClass" value="<?php echo $overtimeNum; ?>" />
				<input type="hidden" name="totalClass"  value="<?php echo $realTotalClass; ?>" />
				<?php
					for($i=0; $i<count($hopeNumArray); $i++) {
						echo '<input type="hidden" name="subject[]" value="'.$subject[$i].'" />';
					}
				?>
				
				<div class="btnBlueDiv">
					<input type="button" value="返回修改" class="btnBlue" onclick="javascript:history.back()"/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="確認送出" class="btnBlue" onclick="popup_modal_submit('您確定要送出嗎？')"/>
				</div>
				
				<!-- 自訂 提醒視窗 -->
				<?php show_popup_model();  /* globefunction.php */ ?>
			</form>
		</div>
	</div>
	
	<!-- jQuery：自訂提醒視窗 -->
	<?php popup_model_submit_javascript("teachercheck");  /* globefunction.php 有form的時候 */ ?>
</body>
</html>