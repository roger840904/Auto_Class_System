<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php session_start();
//將session清空
session_unset();
session_destroy();
echo "<script>window.location.href='index.php';</script>";
?>