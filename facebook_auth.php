<?php
require_once 'config.php';
include 'includes/core.php';
session_start();
	
include 'includes/wss_facebook.php';
	
if ($facebook->getUser()) {
	if (!isset($_GET['signup'])) {
		if (isset($fb_user['id'])) {
			$user_exists = mysql_result(mysql_query("SELECT COUNT(*) FROM wss_users WHERE facebook = 1 AND facebook_id = '$fb_user[id]'"),0);
			if ($user_exists >= 1) {
				// logemin

				$user_q = mysql_query("SELECT * FROM wss_users WHERE facebook = 1 AND facebook_id = '$fb_user[id]'");
				$user_info = mysql_fetch_array($user_q);
			
				setcookie("wss_username", $user_info['username'], time()+60*60*24*100);
				setcookie("wss_code", $user_info['password'], time()+60*60*24*100);
				setcookie("wss_userid", $user_info['id'], time()+60*60*24*100);
			
				header("Location: $setting[site_url]");
			}
			else {
				header("Location: $setting[site_url]/index.php?task=facebook_register");
			}
		}
		else {
			echo 'This site could not retreive the user data from Facebook';
		}
	}
	else {
	//signup part 2
		if ($_POST['username'] != '') {
			$username = mysql_secure($_POST['username']);
			$user_exists = mysql_result(mysql_query("SELECT COUNT(*) FROM wss_users WHERE username = '$username'"),0);
			if ($user_exists == 1) {
				header("Location: $setting[site_url]/?task=facebook_register&e=1");
			}
			else {
				// insert
				//echo 'nice username, shall use!';
				$date = time();
				$random_pass = md5(uniqid(rand(), true));
				
				$email = mysql_secure($fb_user['email']);
				$about = mysql_secure($fb_user['about']);
				$fbid = mysql_secure($fb_user['id']);
				
				$seo_url = seoname($username);
				
				mysql_query("INSERT INTO wss_users (username, password, email, activate, about, joined, facebook, facebook_id, seo_url)
        		VALUES('$username', '$random_pass', '$email', '1', '$about', '$date', 1, '$fbid', '$seo_url')") or die (mysql_error());
        		
        		$new_id = mysql_insert_id();
        		
        		setcookie("wss_username", $username, time()+60*60*24*100);
				setcookie("wss_code", $random_pass, time()+60*60*24*100);
				setcookie("wss_userid", $new_id, time()+60*60*24*100);
				
				header("Location: $setting[site_url]");
			}
		}
		else {
			header("Location: $setting[site_url]/?task=facebook_register&e=2");
		}
	}
}
else {
	echo 'Could not get the Facebook session. The server may not be able to connect to Facebook securely to retrieve the user information.';
}
?>