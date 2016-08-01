<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
require_once("./mysql_connect.inc.php");
?>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>彌陀國小線上排課系統─課表查詢</title>
	<link rel="stylesheet" type="text/css" href="css/style_teacher.css"/>
	<link rel="stylesheet" type="text/css" href="css/styles_main.css"/>
</head>

<body>
	<div class="main">
		<?php include("teacherbutton.php"); ?>
		
		<div class="content" style="text-align:center;">
		<form action="teachertimetable.php" method="POST">
			教師：
			<select name="teacher">
				<option value="all">----尚未選擇----</option>
				<?php
				$sqlTeacher = "SELECT * FROM teacher_info";
				$resultTeacher = mysql_query($sqlTeacher);
				
				while($listTeacher = mysql_fetch_array($resultTeacher))
				{
					echo '<option value="'.$listTeacher['tid'].'">'.$listTeacher['name'].'</option>';
				}
				?>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			班級：
			<select name="class">
				<option value="none">----尚未選擇----</option>
				<?php
				$sqlClass = "SELECT * FROM class_info";
				$resultClass = mysql_query($sqlClass);
				
				while($listClass = mysql_fetch_array($resultClass))
				{
					echo '<option value="'.$listClass['className'].'">'.$listClass['className'].'</option>';
				}
				?>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			教室：
			<select name="room">
				<option value="none">----尚未選擇----</option>
				<?php
				$sqlRoom = "SELECT * FROM room_info";
				$resultRoom = mysql_query($sqlRoom);
				
				while($listRoom = mysql_fetch_array($resultRoom))
				{
					echo '<option value="'.$listRoom['rid'].'">'.$listRoom['roomName'].'</option>';
				}
				?>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" value="送出" style="font-size:18px;"/>
			<br/><br/>
			</form>
		</div>
		
		<br/>
		
		<div align="center"> 
			<table border="1" id="t02" >
				<tr>
					<th width="4%" >節</th>
					<th width="9%" >一</th>
					<th width="9%" >二</th>
					<th width="9%" >三</th>
					<th width="9%" >四</th>
					<th width="9%" >五</th>
				</tr>
					<?php		
						if(isset($_POST['class'])){	
							echo $_POST['class']."的課表";
							echo '<br><br>';
							
							for($i=0;$i<8;$i++){
								echo '<tr>';
								for($j=0;$j<6;$j++){
									if($j==0){
										echo '<td>';
										echo $i+1;
										echo '</td>';
									}else{
										if($i==4){	
										
											echo '<td style="font-style: italic; font-weight: bold;">';
											echo "午休";
											echo '&nbsp';
											echo '</td>';	
																								
										
										}elseif($i>4){
											echo '<td>';
											$k=$i-1;
											$a=$j-1;
											$sql1="SELECT `subjectNum` FROM `class_time_info` WHERE `week`=".$a." and `node`=".$k." and `className`=".$_POST['class'] ;
											$result1=mysql_query($sql1);
											$row1=mysql_fetch_array($result1);
											
											$sql2="SELECT `subjectName` FROM `subject_info` WHERE `subjectNum`=".$row1[0];
											$result2=mysql_query($sql2);
											$row2=mysql_fetch_array($result2);		
											echo $row2[0];
											echo '&nbsp';
											echo '</td>';
										}else{
											echo '<td>';
											$a=$j-1;
											$sql1="SELECT `subjectNum` FROM `class_time_info` WHERE `week`=".$a." and `node`=".$i." and `className`=".$_POST['class'] ;
											$result1=mysql_query($sql1);
											$row1=mysql_fetch_array($result1);
											
											$sql2="SELECT `subjectName` FROM `subject_info` WHERE `subjectNum`=".$row1[0];
											$result2=mysql_query($sql2);
											$row2=mysql_fetch_array($result2);		
											echo $row2[0];
											echo '&nbsp';
											echo '</td>';
										}
									}									
								}
								echo '</tr>';
							}					
						}	
					?>
			</table>
			<br><br>
		</div>
</body>
</html>