<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>彌陀國小線上排課系統─意願調查</title>
	<link rel="stylesheet" type="text/css" href="css/style_teacher.css"/>
	<style>
		input::-webkit-calendar-picker-indicator {
		  display: none;
		}
	</style>
</head>

<body>
	<div class="main">
		<?php include("teacherbutton.php"); ?>
		
		<div class="content">
			<form method="post" action="teachercheck.php">
				<fieldset class="fieldset">
					<legend><h3>超鐘點意願調查</h3></legend>
					1. 102.6.11高市教小第10288725700號建議每周以兼6代5不超過9節為原則。（兼即超鐘點之意）
					<br/>
					2. 法定授課節數：級任老師每周授課16節，科任老師每周授課20節；建議級任老師每周至多超鐘點4節，科任老師每周至多超鐘點2節。
				</fieldset>
				<br/><br/>
				
				教師姓名：<input type="text" id="teacherName" name="teacherName" list="teacherList" maxlength="6"/>
				<datalist id="teacherList">
					<select id="teacher" size="10"></select>
				</datalist>
				<label id="check" style="color:red;"></label>
				<br/><br/>
				是否願意超鐘點：
				<input type="Radio" name="overtime" value="true" checked="checked" />是，
				<input type="text"  name="overtimeNum" maxlength="2" style="width:30px;" />&nbsp;節
				&nbsp;&nbsp;&nbsp;
				<input type="Radio" name="overtime" value="false" />否
　				<br/><br/>
				<hr/><br/>
				
				<fieldset>
					<legend><h3>欲任教科目</h3></legend><br>
					請<i><b><u>依序填入</i></b></u>欲任教科目，標示的順序提供教務處做參考，但因配課因素不一定能全從其意願，敬請見諒。
					<br/><br/>
				</fieldset>
				<br/>
				
				<?php
				$subject = '
					<option value="none">----尚未選擇----</option>
					<option>國語			</option>
					<option>閱讀			</option>
					<option>數學			</option>
					<option>彈性時間		</option>
					<option>綜合活動		</option>
					<option>社會			</option>
					<option>自然與生活科技	</option>
					<option>生活A			</option>
					<option>生活B			</option>
					<option>音樂			</option>
					<option>美勞表演		</option>
					<option>健康			</option>
					<option>體育			</option>
					<option>閩南語			</option>
					<option>資訊			</option>
					<option>英語			</option>
				';
				?>
						<?php
							$hopeNumArray=['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二', '十三', '十四', '十五'];
							echo '<table style="width:100%; text-align:center;">';
							for($i=0; $i<count($hopeNumArray)/5;$i++) {
								echo '<tr>';
								for($j=0; $j<5; $j++){
									echo '<th>意願'.$hopeNumArray[$i*5+$j].'</th>';
								}
								echo '</tr>';
								
								echo '<tr>';
								for($j=0; $j<5; $j++){
									echo '<td><select name="subject[]">'.$subject.'</select></td>';
								}
								echo '</tr>';
							}
							echo '</table>';
						?>
				
				<div class="btnBlueDiv">
					<input id="submit" type="submit" value="送出" class="btnBlue" />
				</div>
			</form>
		</div>
	</div>
	<script>
		var teacherNameInput=document.getElementById('teacherName');
		postToPHP('print_teacher_name.php', '');
		teacherNameInput.addEventListener('change', function() {
			checkName();
		});
	
		function postToPHP(url, postData) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function () {
					if (xhttp.readyState == 4 || xhttp.status == 200) {
						var responseArray = xhttp.responseText.split('@@');
						document.getElementById('teacher').innerHTML = '';
						//var select=document.createElement('select');
						for (var i = 0; i < responseArray.length - 1; i++) {
							var option = document.createElement('option');
							option.innerHTML=responseArray[i].trim();
							//option.setAttribute('value', responseArray[i].trim());
							//select.appendChild(option);
							document.getElementById('teacher').appendChild(option);
						}
						
					}
				}
				xhttp.open('POST', url, true);
				xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhttp.send(postData);
			}
		
		function selectTeacher(url, postData) {
				var xhttp2 = new XMLHttpRequest();
				xhttp2.onreadystatechange = function () {
					if (xhttp2.readyState == 4 || xhttp2.status == 200) {
						// console.log(xhttp.responseText);
						if(xhttp2.responseText==0) {
							document.getElementById('check').innerHTML='無此資料';
							document.getElementById('submit').disabled=true;
						} else {
							document.getElementById('check').innerHTML='';
							document.getElementById('submit').disabled=false;
						}
						
					}
				}
				xhttp2.open('POST', url, true);
				xhttp2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhttp2.send(postData);
			}
		
		function checkName() {
			var teacherNameInputValue=teacherNameInput.value;
			selectTeacher('print_teacher_number.php', 'name='+teacherNameInputValue);
		}
	</script>
</body>
</html>