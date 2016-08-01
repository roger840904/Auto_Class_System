<?php
    require_once('mysql_connect.inc.php');
    $result=mysql_query("SELECT count(*) AS number FROM teacher_info WHERE name='".$_POST['name']."'");
    $row=mysql_fetch_array($result);
    echo $row['number'];
?>