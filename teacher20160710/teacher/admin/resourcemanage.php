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
		<title>資源班管理</title>
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
				<b>資源班管理</b>
			</font>
		</div>	
			
			<div style="text-align:center;">
			<div style="border:2px #ccc solid;padding:20px;" >
			<br>
				<form id="resource" name="resource" method="post" >
					<h2>
						<font>年級：</font>
						<select name="grade" style="width:80px;padding:5px 1px; font-size:16px; ">
							<option value="firstgrade">
								一
							</option>
							<option value="secondgrade">
								二
							</option>
							<option value="thirdgrade">
								三
							</option>
							<option value="fourthgrade">
								四
							</option>
							<option value="fifthgrade">
								五
							</option>
							<option value="sixthgrade">
								六
							</option>
						</select>
						&nbsp;&nbsp;&nbsp;
						<font>班級：</font>
						<select name="class" style="width:80px;padding:5px 1px; font-size:16px; ">
							<option value="firstclass">
								一
							</option>
							<option value="secondclass">
								二
							</option>
							<option value="thirdclass">
								三
							</option>
							<option value="fourthclass">
								四
							</option>
							<option value="fifthclass">
								五
							</option>
						</select>
						&nbsp;&nbsp;&nbsp;
						<font>人數：</font>
						<select name="numberofpeople" style="width:80px;padding:5px 1px; font-size:16px; ">
							<option value="one">
								1
							</option>
							<option value="two">
								2
							</option>
							<option value="three">
								3
							</option>
							<option value="four">
								4
							</option>
							<option value="five">
								5
							</option>
						</select>
						&nbsp;&nbsp;&nbsp;
						<button type="button" class="btnBlue" id="add" onclick="myFunction()">
							新增
						</button>	
					</h2>
					<div id="table"></div>
					
						<table border="1" class="table" id="t01">
							<tbody>
								<tr>
									<th style="height:40px">
										年級
									</th>
									<th style="height:40px">
										班級
									</th>
									<th style="height:40px">
										人數
									</th>
								</tr>
								<tr>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
								</tr>
								<tr>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
								</tr>
								<tr>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
								</tr>
								<tr>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
								</tr>
								<tr>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
								</tr>
								<tr>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
									<td style="height:40px">
										&nbsp
									</td>
								</tr>
							</tbody>
						</table>
					
					</div>
					<br>
					<br>
				
					<input type="button" value="回上一頁" class="btnBlue" onclick="popup_modal_href('您確定要回上一頁嗎？','surveymanage.php')" />
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<input type="button" value="確認送出" class="btnBlue" onclick="popup_modal_submit('您確定要送出嗎？')"/>
			
					<!-- 自訂 提醒視窗 -->
					<?php show_popup_model_admin();  /* globefunction.php */ ?>
				</form>
			</div>
	
	<!-- jQuery：自訂提醒視窗 -->
	<script type="text/javascript" src="../popup_window/jquery.min.js"></script>
	<script type="text/javascript" src="../popup_window/jquery.reveal.js"></script>
	<?php
	popup_model_href_javascript();					/* globefunction.php 純粹跳頁的時候 */
	popup_model_submit_javascript("resource");		/* globefunction.php 有form的時候 */
	?>
	
	<!-------------自訂提醒視窗結束----------------->	
	
	<script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>
	<script>
		var num = 0;
		function myFunction() {
			num++;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() { //啟動監聽器，監聽-->200傳輸成功
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					//			console.log(xhttp.responseText);
					document.getElementById("table").innerHTML = xhttp.responseText;
				}
			}
			xhttp.open("POST", "http://rags0830.ddns.net/teacher/admin/add.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("add=1" + "&num=" + num);
		}
	</script>
	
	</body>
</html>