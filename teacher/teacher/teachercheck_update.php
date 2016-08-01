<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
require_once("./globefunction.php");
require_once("./mysql_connect.inc.php");

show_popup_alert();  /* 自訂提醒視窗 globefunction.php */

$tid = $_POST['tid'];
$exceedClass = $_POST['exceedClass'];
$totalClass  = $_POST['totalClass'];

$subject=$_POST['subject'];
$hopeNumArray=['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二', '十三', '十四', '十五'];

$result = mysql_query("SELECT * FROM survey WHERE tid='$tid'");
$countResult = mysql_num_rows($result);
if($countResult!=0)
{
	/* 老師重複填寫 → 刪除 */
	$sqlDelete = "DELETE FROM survey WHERE tid='$tid'";
	mysql_query($sqlDelete);
}

$hopeSql='';
$hopeValue='';
for($i=0; $i<count($hopeNumArray); $i++) {
	$hopeSql.=', hope'.($i+1);
	$hopeValue.=", '".mysql_real_escape_string($subject[$i])."'";
}
$sql="INSERT INTO survey (tid, exceedClass, totalClass".$hopeSql.") 
	  VALUES ('".mysql_real_escape_string($tid).
	  "', '".mysql_real_escape_string($exceedClass).
	  "', '".mysql_real_escape_string($totalClass).
	  "'".$hopeValue.")";
	if(mysql_query($sql))
	{	?>
		<script>
			location.href="teacherfinish.php";
		</script>
		<?php
		die();
	}
	else
	{	?>
		<script>
			popup_modal_alert("error","送出失敗!","javascript: history.back()");
		</script>
		<?php
		die();
	}
?>