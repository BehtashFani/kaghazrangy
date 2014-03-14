<?php
if (isset($_GET["done"])) {
	require_once 'config.php';
	include 'includes/core.php';
	session_start();

	if ((!$_POST['username']) || (!$_POST['password'])) { // User did not type a username and password		
		header("Location: index.php?task=login&em=1");
	}
	else {
		$username = mysql_secure($_POST['username']);
		$password = md5($_POST['password']);

		$sql = mysql_query("SELECT * FROM wss_users WHERE username='$username' AND password='$password' AND activate='1'");
		$login_check = mysql_num_rows($sql);

		if ($login_check > 0) {
			$row = mysql_fetch_array($sql);
			$user_id = $row['id'];
			
			if (isset($_POST['remember'])) {
				setcookie("wss_username", $username, time()+60*60*24*100);
				setcookie("wss_code", $password, time()+60*60*24*100);
				setcookie("wss_userid", $user_id, time()+60*60*24*100);
			}
			else {
				setcookie("wss_username", $username);
				setcookie("wss_code", $password);
				setcookie("wss_userid", $user_id); 
			}

			if (isset($_GET['action']) && $_GET['action'] == 'admin') {
				header("Location: admin/index.php");
			}
			else if (isset($_GET['nexttask'])) {
				if ($_GET['nexttask'] == 'login') {
					header("Location: index.php");
				}
				else {
					header("Location: index.php?task=".$_GET['nexttask']."&amp;id=".$_GET['nextid']."");
				}
			}
			else {
				header("Location: index.php");
			}
		} 
		else {
			header("Location: index.php?task=login&em=2");
		}
	}
}
else if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	setcookie("wss_username", "", time()-60*60*24*100);
	setcookie("wss_userid", "", time()-60*60*24*100);
	setcookie("wss_code", "", time()-60*60*24*100);
	setcookie("wss_iptrack", "", time()-60*60*24*100);
	header("Location: index.php");
}
else { // No info was submitted - user is requesting login form
	if (isset($_GET['em'])) {
		if ($_GET['em'] == 1) {
			$error_message = LOGIN_ERROR1;
		}
		else {
			$error_message = LOGIN_ERROR2;
		}
	}
	if (isset($template['login_form'])) {
		include '.'.$setting['template_url'].'/'.$template['login_form'];
	}
	else {
		include 'includes/forms/login_form.php';
	}
}
?>