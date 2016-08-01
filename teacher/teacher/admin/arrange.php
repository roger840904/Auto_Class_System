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
		<title>課程編排</title>
		<link rel="stylesheet" type="text/css" href="../popup_window/styles_popup_window.css">
		<link rel="stylesheet" type="text/css" href="../css/styles_main.css"/>
		<link rel="stylesheet" type="text/css" href="../css/styles_login.css"/>
		<link rel="stylesheet" type="text/css" href="../css/styles_modal.css"/>  <!-- 彈跳視窗 -->
	</head>
	<script type="text/javascript">
		function editteacher(){
			var x = document.getElementsByClassName("btnBlue_small edit");
			
			var i;
			for(i=0;i<x.length;i++)
			{
				  
				var modal = document.getElementById('myModal');
				var span = document.getElementsByClassName("close")[0];
				
				x[i].onclick = function() {
				 	modal.style.display = "block";
				}
				span.onclick = function() {
					modal.style.display = "none";
				}
				window.onclick = function(event) {
					if (event.target == modal) {
						modal.style.display = "none";
					}
				}
				
				//有bug，畫面會自動跳?!
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function()
				{
					if (xhttp.readyState == 4 && xhttp.status == 200)
					{
					  var str ="<?php echo $list[subjectName]; ?>";
					  document.getElementById("t01").innerHTML = str;
					}
				};
				  xhttp.open("GET", "arrange.php", true);
				  xhttp.send();
				  
			
			}
	
		}  
	</script>
	<script src="../js/surveymanage.js"></script>
	<body>
	<div id="menu">
		<?php menu();  /* globefunction.php */ ?>
	</div>
	
	<div style="text-align:center;">
		<font style="font-size:52px;">
			<b>課程編排</b>
		</font>
	</div>
	
	<div style="border:2px #ccc solid;padding:30px;">
		<div style="font-size:24px;">
			班級:&nbsp;&nbsp;&nbsp;&nbsp;
			<!-- 設一個form 自動生成所有班級 -->
		<form name="arrange" id="arrange" method="post" enctype="multipart/form-data" action="arrange.php">
				
			<div style="float:left;height:150px">
				<table style="margin:10px;height:200px">
					<?php
					$query_sql_1 = "SELECT * FROM class_info where gradeNumber='1' ORDER BY cid ASC";
					$result_1 = mysql_query($query_sql_1);
					
					$query_sql_2 = "SELECT * FROM class_info where gradeNumber='2' ORDER BY cid ASC";
					$result_2 = mysql_query($query_sql_2);
					
					$query_sql_3 = "SELECT * FROM class_info where gradeNumber='3' ORDER BY cid ASC";
					$result_3 = mysql_query($query_sql_3);
					
					$query_sql_4 = "SELECT * FROM class_info where gradeNumber='4' ORDER BY cid ASC";
					$result_4 = mysql_query($query_sql_4);
					
					$query_sql_5 = "SELECT * FROM class_info where gradeNumber='5' ORDER BY cid ASC";
					$result_5 = mysql_query($query_sql_5);
					
					$query_sql_6 = "SELECT * FROM class_info where gradeNumber='6' ORDER BY cid ASC";
					$result_6 = mysql_query($query_sql_6);
					
					// 如果出現錯誤並退出
					if(!$result_1){
						exit('查詢資料錯誤：'.mysql_error());
					}
					
					// 迴圈輸出
					?>	<tr>
					<?php
						while($list_1=mysql_fetch_array($result_1))
						{	?>
							<td width="10%"><input type="submit" class="btnOrange" name="className" value=" <?php echo $list_1[className];?> "></td>
							<?php
						} ?>
						</tr>
						<tr>
					<?php
						while($list_2=mysql_fetch_array($result_2))
						{	?>
							<td width="10%"><input type="submit" class="btnOrange" name="className" value=" <?php echo $list_2[className];?> "></td>
							<?php
						} ?>
						</tr>
						<tr>
					<?php
						while($list_3=mysql_fetch_array($result_3))
						{	?>
							<td width="10%"><input type="submit" class="btnOrange" name="className" value=" <?php echo $list_3[className];?> "></td>
							<?php
						} ?>
						</tr>
						<tr>
					<?php
						while($list_4=mysql_fetch_array($result_4))
						{	?>
							<td width="10%"><input type="submit" class="btnOrange" name="className" value=" <?php echo $list_4[className];?> "></td>
							<?php
						} ?>
						</tr>
						<tr>
					<?php
						while($list_5=mysql_fetch_array($result_5))
						{	?>
							<td width="10%"><input type="submit" class="btnOrange" name="className" value=" <?php echo $list_5[className];?> "></td>
							<?php
						} ?>
						</tr>
						<tr>
					<?php
						while($list_6=mysql_fetch_array($result_6))
						{	?>
							<td width="10%"><input type="submit" class="btnOrange" name="className" value=" <?php echo $list_6[className];?> "></td>
							<?php
						} ?>
						</tr>
							
				</table>
			</div>
		</form>		
		</div>
		
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<div style="float:left;font-size:24px">
			<div>
				目前班級: 
				<font style="font-size:28px;color:red;">
				<?php 
				$className=$_POST['className'];
				echo $className;?>
				</font>
			</div>
		</div>
		<br>
		<!-- 設form 自動帶出各班級資料 -->
		<form id="sform" name="sform" method="post" enctype="multipart/form-data" >
		<table border="1" class="table" id="t01">
		<tbody>
			<tr>
				<th>科目</th>
				<th>堂數</th>
				<th>授課老師</th>
				<th>編輯</th>
			</tr>
			<?php
				$className=$_POST['className'];
			//	SELECT `科目`,`堂數` FROM A,B WHERE A.qq=B.qq AND `gradeNumber` = (SELECT `gradeNumber` FROM )
				$sql=" select subject_info.subjectName,grade_schema_info.gradeSubjectNum from grade_schema_info,subject_info where grade_schema_info.SubjectNum = subject_info.subjectNum and gradeNumber = ( select gradeNumber from class_info where className = $className ) ";		
				$result = mysql_query($sql);		
				// 迴圈輸出
				$count_result = mysql_num_rows($result);  // 計算筆數
				
				if($count_result == 0)
				{	?>
					<tr>
						<td colspan="4"><font style="font-size:36px;color:red;">請選擇班級進行課程編排!</font></td>
					</tr>
					<?php
				}
				else
				{
					while($list = mysql_fetch_array($result))
					{	?>	
						<tr>
							<td><?php echo $list[subjectName];?></td>
							<td><?php echo $list[gradeSubjectNum];?></td>
							<td> <!-- 授課老師 --> </td>
							<td> <span class="showModal"><input type="button" value="編輯" class="btnBlue_small edit" onclick="editteacher()"></span></td>  <!-- value可能要改 -->
						</tr>
			<?php	} 
				}  ?>
		</tbody>
		</table>
		</form>
	</div>
	
	<!-- 編輯授課老師的彈出視窗 -->

	<div id="myModal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<span class="close">close</span>
				<span class="h2">選擇該堂授課老師</span>
			</div>
			<div class="modal-body">
				<table border="1" id="t01" style="margin:30px 0;">
					<tr>
						<th width="40%">教師姓名</th>
						<th width="40%">職稱</th>
						<th width="20%">選擇</th>
					</tr>
					<?php
					//點下編輯button後的彈跳視窗  (survey.hope1 = $list[subjectName] || survey.hope2 = $list[subjectName] || survey.hope3 = $list[subjectName])
						$result_edit = mysql_query("select teacher_info.* from teacher_info left join survey on teacher_info.tid = survey.tid
															where survey.hope1 = str ");
						$num_edit = mysql_num_rows($result_edit);
						
						while($list_edit = mysql_fetch_array($result_edit))
						{
							echo '<tr>
									<td>'.$list_edit['name'].'</td>
									<td>'.$list_edit['jobTitle'].'</td>
									<td><input type="submit" value="選擇" class="btnBlue_small edit" onclick=""></td>
								  </tr>';
						}
					
					?>
				</table>
			</div>
			<div class="modal-footer">
				<span class="h3">共有&nbsp;<?php echo $num_edit; ?>&nbsp;位</span>
			</div>
		</div>
	</div>

	</body>
</html>