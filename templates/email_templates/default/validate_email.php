<?php 
include 'header.php';
$message .= '
	'.EMAIL_GREETING.' '.$data['to_username'].' '.EMAIL_REGISTER_INTRO.'
	<br /><br />
	'.EMAIL_REGISTER_VINFO.'<br /><br />
	<a href="'.$data['validate_url'].'">'.EMAIL_REGISTER_VALIDATE.'</a>
'; 
include 'footer.php';
?>