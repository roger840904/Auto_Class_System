<?php
    session_start();
    require_once('../mysql_connect.inc.php');
    $file="教師意願調查表".date("YmdHis").".xls";
    header("Content-type: application/vnd.ms-excel"); //文件內容為excel格式
    header("Content-Disposition: attachment; filename=$file;"); //將PHP轉成下載的檔案指定名稱與副檔名.xls
    
    echo '<HTML xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">'."\n";
    echo '<head><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"></head>'."\n";
    echo '<body>';

    $schema=[];
    $result=mysql_query("SHOW FULL COLUMNS FROM survey");
    echo '<table>';
    echo '<tr>';
    while($row=mysql_fetch_array($result)){
        if($row['Comment']!='教師流水編號') {
            echo '<th>'.$row['Comment'].'</th>';
            $schema[]=$row['Field'];
        } else {
			echo '<th>教師姓名</th>';
			$schema[]='tid';
		}
    }
    echo '</tr>';
    
    $result=mysql_query("SELECT * FROM survey");
	$rowCount=1;
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)) {
        echo '<tr>';
        for($i=0; $i<count($row); $i++) {
			if($schema[$i]=='tid') {
				$result2=mysql_query("SELECT * FROM `teacher_info` WHERE `tid`=".$row['tid']);
				$row2=mysql_fetch_array($result2, MYSQL_ASSOC);
				echo '<td>'.$row2['name'].'</td>';
			} else if($schema[$i]=='sid') {
				echo '<td>'.$rowCount.'</td>';
			} else {
				echo '<td>'.$row[$schema[$i]].'</td>';
			}
        }
        echo '</tr>';
		$rowCount++;
    }

    echo '</table>';
    echo '</body></html>';
?>