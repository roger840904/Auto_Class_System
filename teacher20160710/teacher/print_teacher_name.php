<?php
    require_once('mysql_connect.inc.php');
    $result=mysql_query("SELECT * FROM teacher_info");
    while($row=mysql_fetch_array($result)){
        echo $row['name'].'@@';
    }
?>