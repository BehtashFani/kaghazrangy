<?php
defined( 'WSS_' ) or die( '' );
if ($user['login_status'] != 0) {
	if (isset($_POST['location'])) {

		$location = mysql_secure($_POST['location']);
		$interests = mysql_secure($_POST['interests']);
		$about = mysql_secure($_POST['about']);
		$website = mysql_secure($_POST['website']);
		$id = intval($user['id']);

		mysql_query("UPDATE wss_users SET location='$location', interests='$interests', about='$about', website='$website' WHERE id='$id'")
			or die (mysql_error());

		$pass = str_replace(' ', '', $_POST['new_password']);

		if ($pass != '') {
			echo 'PW Changes';
			$password = md5($_POST['new_password']);
			mysql_query("UPDATE wss_users SET password='$password' WHERE id='$id'")
				or die (mysql_error());
		}

		echo '<div id="error_message">'.PROFILE_UPDATED."</div>";
	}
	else if (isset($_GET['done']) && $_GET['done'] == 'avatar') {
			include('avatar_upload.php');
		}

	$sql = mysql_query("SELECT * FROM wss_users WHERE id= $user[id]");
	$row = mysql_fetch_array($sql);
	$location2 = $row['location'];
	$interests2 = $row['interests'];
	$about2 = $row['about'];
	$website2 = $row['website'];

	if ($row['avatar'] != '') {
		$avatar = $row['avatar'];
	}
	else {
		$avatar = 'default.png';
	}

	if (isset($template['edit_profile_form'])) {
		include('.'.$setting['template_url'].'/'.$template['edit_profile_form']);
	}
	else {
		include('./includes/forms/edit_profile_form.php');
	}
}

?>
