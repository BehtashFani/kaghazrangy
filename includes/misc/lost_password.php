<?php 
if (isset($_GET['step']) && $_GET['step'] == 2) {
	$email = mysql_secure($_POST['email']);
	$valid_email = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_users WHERE email='$email'"),0); 
	if ($valid_email == 1) {
		$sql = mysql_query("SELECT * FROM wss_users WHERE email='$email'");
		$row = mysql_fetch_array($sql);
		
		$data = array('to_username' => $row['username'], 'email_address' => $row['email'], 'subject' => EMAIL_PASSWORD_HEADER, 'ip_address' => $_SERVER['REMOTE_ADDR'], 'send_email' => 1);
		$data['reset_link'] = $setting['site_url'].'/index.php?task=lost_password&step=3&id='.$row['id'].'&reset_code='.$row['password'];
		
		SendEmail($data, 'reset_password');
		    	
    	echo LP_EMAIL_SENT;
    }
    else {
    	echo '<div id="error_message">'.LP_ERROR1.'</div>';
    	if (isset($template['lost_password_form'])) {
			include '.'.$setting['template_url'].'/'.$template['lost_password_form'];
		}
		else {
			include 'includes/forms/lost_password_form.php';
		}
    }
}

else if (isset($_GET['step']) && $_GET['step'] == 3) {
	$id = intval($_GET['id']);
	$reset_code = mysql_secure($_GET['reset_code']);
	$valid_details = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_users WHERE id='$id' AND password='$reset_code'"),0); 
	if ($valid_details == 1) {
		echo '<div id="error_message">'.LP_MSG1.'</div>';
		if (isset($template['lost_password_form2'])) {
			include '.'.$setting['template_url'].'/'.$template['lost_password_form2'];
		}
		else {
			include 'includes/forms/lost_password_form2.php';
		}
	}
	else {
		echo '<div id="error_message">'.LP_ERROR2.'</div>';
	}
}

else if (isset($_GET['step']) && $_GET['step'] == 4) {
	$id = intval($_GET['id']);
	$reset_code = mysql_secure($_GET['reset_code']);
	$valid_details = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_users WHERE id='$id' AND password='$reset_code'"),0); 
	if ($valid_details == 1) {
		if ($_POST['password1'] == $_POST['password2'] && $_POST['password1'] != '') {
			$new_password = md5($_POST['password1']);
			mysql_query("UPDATE wss_users SET password='$new_password' WHERE id=$id");
			echo '<div id="error_message">'.LP_SUCCESS.'</div>';
		}
		else {
			echo '<div id="error_message">'.LP_ERROR3.'</div>';
			include 'includes/forms/lost_password_form2.php';
		}
	}
	else {
		echo '<div id="error_message">'.LP_ERROR2.'</div>';
	}
}

else {
	if (isset($template['lost_password_form'])) {
		include '.'.$setting['template_url'].'/'.$template['lost_password_form'];
	}
	else {
		include 'includes/forms/lost_password_form.php';
	}
}
?>