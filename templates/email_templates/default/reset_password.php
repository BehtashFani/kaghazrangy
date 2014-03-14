<?php 
include 'header.php';
$message .= '
	'.EMAIL_GREETING.' '.$data['to_username'].EMAIL_PASSWORD_INTRO.'
	<br /><br />
	'.EMAIL_PASSWORD_IP.': <b>'.$data['ip_address'].'</b><br /><br />
	<a href="'.$data['reset_link'].'">'.EMAIL_PASSWORD_RESET_LINK.'</a>
'; 
include 'footer.php';
?>