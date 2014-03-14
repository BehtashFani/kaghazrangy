<?php
$userid = intval($_GET['id']);
$code = mysql_secure($_GET['code']);
if (isset($_GET['code'])) {

	$code_check = mysql_query("SELECT * FROM wss_users WHERE id='$userid' AND password='$code' AND activate = ''");
	$check = mysql_num_rows($code_check);
	if ($check == 1) {

		mysql_query("UPDATE wss_users SET activate='1' WHERE id='$userid' AND password='$code'");
		$user = mysql_fetch_array($code_check);
		if ($user['referrer'] != 0) {
			$new_user = $userid;
			$date = time();
			$profile_url = ProfileUrl($new_user, seoname($username));
			mysql_query("INSERT INTO wss_messages (user_id, sender_id, sender_name, title, message, date) 
			VALUES ('$user[referrer]', '$new_user', '$user[username]', '$user[username] ".REF_PM_TITLE." $setting[site_name]', '$user[username] ".REF_PM_MESSAGE.": <a href=\"$profile_url\">$profile_url</a>', '$date')");
		}

		echo '<div id="error_message">'.VALIDATED.'</div>';

	} else {
		echo '<div id="error_message">Invalid code for that user</div>'; 
	}
} else {
	echo '<div id="error_message">Invalid codez</div>'; 
}

?> 