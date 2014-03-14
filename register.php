<?php

if (isset($template['register_form'])) {
	$register_form = '.'.$setting['template_url'].'/'.$template['register_form'];
}
else {
	$register_form = 'includes/forms/register_form.php';
}

if (isset($_GET['done'])) {
	// Include reCaptcha
	if ($setting['use_captcha'] == 1) {
		require_once('includes/misc/recaptchalib.php');
		$resp = recaptcha_check_answer ($setting['captcha_privkey'],
            		$_SERVER["REMOTE_ADDR"],
                	$_POST["recaptcha_challenge_field"],
                	$_POST["recaptcha_response_field"]);
        if ($resp->is_valid) {
        	$captcha_success = 1;
        }
        else {
        	$captcha_success = 0;
       	}
    }
    else {
	    $captcha_success = 1;
    }
    if ($setting['use_qa_captcha'] == 1) {
    	$user_answer = secure(strtolower($_POST["qa_captcha_answer"]));
    	$formatted_answers = str_replace(", ", ",", strtolower($setting['qa_captcha_answers']));
    	
    	$answers = explode(',', $formatted_answers);
    	foreach ($answers as $answer) {
    		if ($answer == $user_answer) {
    			$qa_captcha_success = 1;
    		}
		}
		
		if (!isset($qa_captcha_success)) {
			$qa_captcha_success = 0;
		}
    }
    else {
	    $qa_captcha_success = 1;
    }
                
	// Get form data & secure where needed
	$username = mysql_secure($_POST['username']);
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$email = mysql_secure($_POST['email']);
	
	$username_valid = preg_match('/^[A-Za-z ][A-Za-z0-9 ]*(?:_[A-Za-z0-9 ]+)*$/', $_POST['username']);

	// Check if all sections were submitted and display correct error
	if ((!$username) || (!$email) || (!$password) || (!$password2) || ($password != $password2) || ($captcha_success == 0) || ($qa_captcha_success == 0) || ($username_valid == false)) {
		echo '<div id="error_message">'.REG_ERROR1.':<br />';
		if ((!$username) || ($username_valid == false)) {
			echo REG_ERROR2."<br />";
		}
		if (!$email) {
			echo REG_ERROR8."<br />";
		}
		if (!$password) {
			echo REG_ERROR3."<br />";
		}
		if ($password != $password2) {
			echo REG_ERROR4."<br />";
		}
		if ((isset($captcha_success) && $captcha_success == 0) || (isset($qa_captcha_success) && $qa_captcha_success == 0)) {
			echo 'Incorrect answer on captcha';
		}
		echo '</div>';
		include $register_form;
	}
	else {
		// Is username in use?
		$sql_username_check = mysql_query("SELECT username FROM wss_users WHERE username='$username'");
		$username_check = mysql_num_rows($sql_username_check);
		// Is email in use?
		$sql_email_check = mysql_query("SELECT email FROM wss_users WHERE email='$email'");
		$email_check = mysql_num_rows($sql_email_check);
		
		// Email or username is in use
		if (($email_check > 0) || ($username_check > 0)) {
			echo '<div id="error_message">'.REG_ERROR6.':<br />';
			if ($email_check > 0) {
				echo REG_ERROR5."<br />";
			}
			if ($username_check > 0) {
				echo REG_ERROR7."<br />";
			}
			echo '</div>';
			include $register_form;
		}
		// No errors, proceed 
		else {
			$passwordpro = md5($password);
			$username = htmlspecialchars($username);
			$date = time();
			
			if (isset($_COOKIE['wss_ref'])) {
				$referrer = intval($_COOKIE['wss_ref']);
			}
			else {
				$referrer = 0;
			}
			$seo_url = seoname($username);
			$user_ip = mysql_secure($_SERVER['REMOTE_ADDR']);
			// If email validation is off, instantly activate the account
			if ($setting['email_on'] == 0) {
				$sql = mysql_query("INSERT INTO wss_users (username, password, email, activate, joined, referrer, lastip, seo_url)
        		VALUES('$username', '$passwordpro', '$email', '1', '$date', $referrer, '$user_ip', '$seo_url')") or die (mysql_error());
        		$new_user = mysql_insert_id();
        		if (isset($_COOKIE['wss_ref'])) {					
					$date = time();
					$profile_url = ProfileUrl($new_user, seoname($username));
					mysql_query("INSERT INTO wss_messages (user_id, sender_id, sender_name, title, message, date) 
					VALUES ('$referrer', '$new_user', '$username', '$username ".REF_PM_TITLE." $setting[site_name]', '$username ".REF_PM_MESSAGE.": <a href=\"$profile_url\">$profile_url</a>', '$date')");
				}
				echo VALIDATED;
			}
			// Email validation is on: create account and send validation email
			else {
				$sql = mysql_query("INSERT INTO wss_users (username, password, email, joined, referrer, lastip, seo_url)
       			VALUES('$username', '$passwordpro', '$email', '$date', $referrer, '$user_ip', '$seo_url')") or die (mysql_error());

				$userid = mysql_insert_id();				
				$data = array('email_address' => $email, 'to_username' => $username, 'subject' => EMAIL_REGISTER_HEADER.' '.$username, 'send_email' => 1);
				$data['validate_url'] = $setting['site_url'].'/index.php?task=validate&id='.$userid.'&code='.$passwordpro;

    			SendEmail($data, 'validate_email');


				echo EMAIL4; // Email sent message
			}
		}
	}
}
else {
	include $register_form;
}
?>