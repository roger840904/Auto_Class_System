<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	header("Content-Type:text/html; charset=utf-8");
	
	$subject = $_POST['subject'];
	$username = $_POST['username'];
    $email_message = $_POST['email_message'];
	$email_message = str_replace ("XXX",$username,$email_message);
    $email_from = $_POST['email_from'];
	
	$to      = $_POST['email'];
	$subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
	$message = $email_message; // E-mail信件內容
	$headers = 'From:' . mysql_real_escape_string($email_from) . "\r\n" .
				'Reply-To:' . mysql_real_escape_string($email_from) . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			
	if (!(mail($to, $subject, $message, $headers)))
	{	?>
		<script language="javascript">
			alert("E-mail寄送成功!");
			history.back();
		</script>
		<?php
	}
	else
	{	?>
		<script language="javascript">
			alert("E-mail寄送失敗!");
			history.back();
		</script>
		<?php
	}?>
