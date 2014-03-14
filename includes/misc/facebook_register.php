<?php
include 'includes/wss_facebook.php';

if ($facebook->getUser() && $user['login_status'] == 0) {	
	if (isset($_GET['e'])) {
		if ($_GET['e'] == 1) {
			$error_message = FB_REGERROR1;
		}
		else {
			$error_message = FB_REGERROR2;
		}
		echo '<div id="error_message">'.$error_message.'</div>';
	}

	include 'includes/forms/facebook_form.php';
	
}
else {
	echo FB_INVALID;
}
?>