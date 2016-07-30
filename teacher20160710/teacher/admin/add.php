<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: text/html; charset=utf-8');
	echo '<thead>';
	if(isset($_POST["num"]) && $_POST["add"] == 1){
		for($i=0;$i<$_POST["num"];$i++){
			echo '<font>年級：</font>
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
						</select>';
		echo '<br>';
		}
	}
	else{
		echo 'error';
	}
	
echo '</thead>';
?>