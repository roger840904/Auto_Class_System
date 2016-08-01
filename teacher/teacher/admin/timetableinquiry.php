<!DOCTYPE html>
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
	<title>課表查詢</title>
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
			<b>課表查詢</b>
		</font>
	</div>	
	
	<div style="width:90%; border:2px #ccc solid;padding:20px; background-color:#ECECFF; margin: 0px auto; text-align:center;" >
		<form action="timetableinquiry.php" method="POST">
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
	
	<br>
	
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
									echo '<td class="tdText" style="text-align: center;">';
									$k=$i-1;
									$a=$j-1;
									$sql1="SELECT `subjectNum` FROM `class_time_info` WHERE `week`=".$a." and `node`=".$k." and `className`=".$_POST['class'] ;
									$result1=mysql_query($sql1);
									$row1=mysql_fetch_array($result1);
									
									$sql2="SELECT `subjectName` FROM `subject_info` WHERE `subjectNum`=".$row1[0];
									$result2=mysql_query($sql2);
									$row2=mysql_fetch_array($result2);		
									echo '<span>'.$row2[0].'&nbsp</span>';
									if($row2[0]!='') {
										echo '<input type="text" style="text-align: center;display: none;width:100%;" data-col="'.($j-1).'" data-row="'.($i).'" data-class="'.$_POST['class'].'"/>';
									}

									
									echo '</td>';
								}else{
									echo '<td class="tdText" style="text-align: center;">';
									$a=$j-1;
									$sql1="SELECT `subjectNum` FROM `class_time_info` WHERE `week`=".$a." and `node`=".$i." and `className`=".$_POST['class'] ;
									$result1=mysql_query($sql1);
									$row1=mysql_fetch_array($result1);
									
									$sql2="SELECT `subjectName` FROM `subject_info` WHERE `subjectNum`=".$row1[0];
									$result2=mysql_query($sql2);
									$row2=mysql_fetch_array($result2);		
									echo '<span>'.$row2[0].'&nbsp</span>';
									if($row2[0]!='') {
										echo '<input type="text" style="text-align: center;display:none;width: 100%;" data-col="'.($j-1).'" data-row="'.($i).'" data-class="'.$_POST['class'].'"/>';
									}
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
	<script>
		var tdText=document.querySelectorAll('.tdText');
		for(let i=0; i<tdText.length; i++) {
			tdText[i].addEventListener('click', function() {
				let span=tdText[i].querySelector('span');
				let input=tdText[i].querySelector('input');
				span.style.display='none';
				input.style.display='block';
				input.addEventListener('blur', function() {
					let oldValue=span.innerHTML;
					let newValue=input.value;
					let dataCol=this.getAttribute('data-col');
					let dataRow=this.getAttribute('data-row');
					let dataClass=this.getAttribute('data-class');
					span.innerHTML=newValue;
					
					sendXhrRequest('select_subject.php', 'oldValue='+oldValue, 'POST', function(response) {
						console.log(response);
					});
					
					// console.log(this.getAttribute('data-col')+' '+this.getAttribute('data-row')+' '+newValue+' '+this.getAttribute('data-class'));
					
					
					input.style.display='none';
					span.style.display='block';
				});
				input.focus();
			});			
		}
		
		function sendXhrRequest(url, data, method, callback) {
			if (url != null && data != null && method != null && callback != null) { //輸入變數不能有null
				if (typeof (callback) === 'function') { //callback一定要是function
					if (method == 'POST' || method == 'GET') { //method只能是POST或GET
						let xhttp = new XMLHttpRequest(); //開始進行XHR
						xhttp.onreadystatechange = function () {
							if (this.readyState == 4 && this.status == 200) {
								callback(this.responseText);
							}
						};

						xhttp.open(method, url, true);
						if (method == 'POST') { //如果方法使用POST
							xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
						}
						xhttp.send(data); //資料送出
					} else {
						console.log('you have to use POST or GET to be method of xhr.');
					}
				} else {
					console.log('callback must be function.');
				}
			} else {
				console.log('cannot have null arguments.');
			}
		}
	</script>
</body>
</html>