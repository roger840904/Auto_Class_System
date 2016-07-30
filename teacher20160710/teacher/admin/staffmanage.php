<?php session_start();
require_once("../globefunction.php");
require_once("../mysql_connect.inc.php");
require_once("./judge_login.php");
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>教職管理</title>
	<link rel="stylesheet" type="text/css" href="../css/styles_main.css"/>
	<link rel="stylesheet" type="text/css" href="../css/styles_login.css"/>
</head>

<body>
	<div id="menu">
		<?php menu();  /* globefunction.php */ ?>
	</div>
	
	<div style="text-align:center;">
			<font style="font-size:52px;">
				<b>教職管理</b>
			</font>
	</div>
	
	<div style="border:2px #ccc solid; padding:20px;">
		<div style="text-align:right;">
			<a id="add" onclick="document.getElementById('insertTeacherInfo').style.display='block';
								 document.getElementById('hidden').style.display='block';
								 document.getElementById('add').style.display='none';">
				<img src="../image/add.png" title="新增教職員資料" style="width:40px; height:40px;">
			</a>
			<a id="hidden" style="display:none;" 
				onclick="document.getElementById('insertTeacherInfo').style.display='none';
						 document.getElementById('hidden').style.display='none';
						 document.getElementById('add').style.display='block';">
				<img src="../image/hidden.png" title="隱藏新增表格" style="width:40px; height:40px;">
			</a>
		</div>
		<br/>
		
		<form id="insertTeacherInfo" method="post" action="staff_info_insert.php" style="display:none;">
			<table border="1" class="table" id="t01" style="width:90%; float:left; margin: 0 20px 20px 0;">
				<tbody>
					<tr>
						<th width="15%">教師姓名</th> 
						<th width="20%">職稱</th>
						<th width="10%">應授課節數</th>
						<th width="10%">減課節數</th>
						<th width="20%">限制</th>
					</tr>
					<tr>
						<td><input type="text" class="add" name="name"/></td> 
						<td><input type="text" class="add" name="jobTitle"/></td>
						<td><input type="text" class="add" name="jobClass"/></td>
						<td><input type="text" class="add" name="subClass"/></td>
						<td><input type="text" class="add" name="limit"/></td>
					</tr>
				</tbody>
			</table>
			<input type="submit" value="新增" class="btnBlue_small" style="margin-top:30px;"/>
		</form>
		
		<table border="1" class="table" id="t01">
			<tbody>
				<tr>
					<th width="15%">教師姓名</th>
					<th width="20%">職稱</th>
					<th width="12%">教師授課節數</th>
					<th width="11%">減課節數</th>
					<th width="12%">實際配課節數</th>
					<th width="20%">限制</th>
					<th width="10%">刪除</th>
				</tr>
				
				<?php
				$i = 0;
				$result = mysql_query("SELECT * FROM teacher_info");
				while($row = mysql_fetch_array($result))
				{
					echo '<tr>';
					echo '<td class="tdText" data-col="name"	  data-row="'.$row['tid'].'" data-myrow="'.$i.'"><span>'.$row['name'].'</span>    <input class="modify" data-col="name"     data-row="'.$row['tid'].'" value="'.$row['name'].'"></td>';
					echo '<td class="tdText" data-col="jobTitle"  data-row="'.$row['tid'].'" data-myrow="'.$i.'"><span>'.$row['jobTitle'].'</span><input class="modify" data-col="jobTitle" data-row="'.$row['tid'].'" value="'.$row['jobTitle'].'"></td>';
					echo '<td class="tdText" data-col="jobClass"  data-row="'.$row['tid'].'" data-myrow="'.$i.'"><span>'.$row['jobClass'].'</span><input class="modify" data-col="jobClass" data-row="'.$row['tid'].'" value="'.$row['jobClass'].'"></td>';
					echo '<td class="tdText" data-col="subClass"  data-row="'.$row['tid'].'" data-myrow="'.$i.'"><span>'.$row['subClass'].'</span><input class="modify" data-col="subClass" data-row="'.$row['tid'].'" value="'.$row['subClass'].'"></td>';
					echo '<td class="result" data-col="realClass" data-row="'.$row['tid'].'" data-myrow="'.$i.'">'.$row['realClass'].'</td>';
					echo '<td class="tdText" data-col="limit"     data-row="'.$row['tid'].'" data-myrow="'.$i.'"><span>'.$row['limit'].'</span>   <input class="modify" data-col="limit"    data-row="'.$row['tid'].'" value="'.$row['limit'].'"></td>';
					echo '<td><button class="btnBlue_small" id="'.$row['tid'].'" onclick="deleteTeacherInfo(this.id)">刪除</button></td>';
					echo '</tr>';
					$i = $i + 1;
				}
				?>
			</tbody>
		</table>
	</div>
	
	<script>
		for(let i=0;i<document.getElementsByClassName('tdText').length;i++){
			document.getElementsByClassName('tdText')[i].addEventListener('click',function(){
				let span=document.getElementsByClassName('tdText')[i].getElementsByTagName('span')[0];
				let input=document.getElementsByClassName('tdText')[i].getElementsByTagName('input')[0];
				span.style.display='none';
				input.style.display='block';
				input.addEventListener('blur',function(){
					let newValue=input.value;
					let dataCol=input.getAttribute('data-col');
					let dataRow=input.getAttribute('data-row');
					let myRow=parseInt(document.getElementsByClassName('tdText')[i].getAttribute('data-myrow'));
					span.innerHTML=newValue;
					updateTeacherInfo(dataCol,dataRow,newValue);
					input.style.display='none';
					span.style.display='block';
					if(dataCol=='subClass' || dataCol=='jobClass') {
						document.getElementsByClassName('result')[myRow].innerHTML=parseInt(document.getElementsByClassName('tdText')[myRow*5+2].getElementsByTagName('span')[0].innerHTML)-parseInt(document.getElementsByClassName('tdText')[myRow*5+3].getElementsByTagName('span')[0].innerHTML);
						updateTeacherInfo('realClass',dataRow,document.getElementsByClassName('result')[myRow].innerHTML);
						
					}
				});
				input.focus();
			});
		}
	</script>
	<script src="../js/staffmanage.js"></script>
</body>
</html>