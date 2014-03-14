<?php
session_start();
require_once 'config.php';
include 'includes/core.php';

// Include language file
include 'language/'.$setting['language'].'.php';

$time_now = time();
// Check for login & valid cookie
$sql = mysql_query("SELECT * FROM wss_cats ORDER BY id");
if (isset($_COOKIE["wss_username"])) {
	$xuser = $_COOKIE['wss_username'];
	$xcode = $_COOKIE['wss_code'];
	$xuserid = intval($_COOKIE['wss_userid']);
	$xcode2 = preg_replace("/[^a-z,A-Z,0-9]/", "", $xcode);


	$sql = mysql_query("SELECT * FROM wss_users WHERE id='$xuserid' AND password='$xcode2' LIMIT 1");
	$login_check = mysql_num_rows($sql);
	if ($login_check <= 0) {
		include ('includes/misc/login_fail.php');
		exit();
	}
	else {
		if ($login_check['facebook'] == 1) {
			include ('wss_facebook.php');
			if ($facebook_session == 1)
				$continue = 1;
			else
				$continue = 0;
				setcookie("wss_username", "", time()-60*60*24*100);
				setcookie("wss_userid", "", time()-60*60*24*100);
				setcookie("wss_code", "", time()-60*60*24*100);
				setcookie("wss_iptrack", "", time()-60*60*24*100);
		}
		else {
			$continue = 1;
		}
		
		if ($continue == 1) {
			$get_user_info = mysql_fetch_array($sql);
			$user = array('username' => $get_user_info['username'], 'code' => $_COOKIE['wss_code'], 'id' => intval($_COOKIE['wss_userid']), 'login_status' => 1, 'messages' => $get_user_info['messages'], 'facebook' => $get_user_info['facebook'], 'facebook_id' => $get_user_info['facebook_id'], 'seo_url' => $get_user_info['seo_url']);
		
			$user['ip'] = mysql_secure($_SERVER['REMOTE_ADDR']);
		
			if ($get_user_info['avatar'] == '') {
				if ($get_user_info['facebook'] == 1) {
					$user['avatar'] = 'http://graph.facebook.com/'.$get_user_info['facebook_id'].'/picture';
				}
				else {
					$user['avatar'] = $setting['site_url'].'/uploads/avatars/default.png';
				}
			}
			else {
				$user['avatar'] = $setting['site_url'].'/uploads/avatars/'.$get_user_info['avatar'];
			}
		
			$user['url'] = ProfileUrl($user['id'], $get_user_info['seo_url']);
		
			if ($setting['seo_on'] == 0) {
				$user['message_url'] = $setting['site_url'].'/index.php?task=messages';
			}
			else {
				$user['message_url'] = $setting['site_url'].'/messages'.$setting['seo_extension'];
			}
		
			if ($get_user_info['admin'] == 1) {
				$user['admin'] = 1;
				$user['admin_link'] = '<a href='.$setting['site_url'].'/admin/>'.UA_ADMIN.'</a>';
			}
			else {
				$user['admin'] = 0;
				$user['admin_link'] = '';
			}
		
			// Update the user IP if this is a new session, update users last activity
			if (!isset($_COOKIE['wss_iptrack'])) {
				mysql_query("UPDATE wss_users SET lastip = '$user[ip]', last_activity = '$time_now' WHERE id = $user[id]") or die (mysql_error());
				setcookie("wss_iptrack", '1');
			}
			else {
				mysql_query("UPDATE wss_users SET last_activity = '$time_now' WHERE id = $user[id]") or die (mysql_error());
			}
		}
		else {
			$user['login_status'] = 0;
			$user['admin'] = 0;
		}
	}
}
else {
	$user['login_status'] = 0;
	$user['admin'] = 0;
}

if (isset($_COOKIE['wss_previouslyviewed'])) 
	$user['previously_viewed'] = mysql_secure($_COOKIE['wss_previouslyviewed']);
else
	$user['previously_viewed'] = '';

define('WSS_', 1);

// Update users online
include 'includes/update_users_online.php';

// Support for SEO search URL's
if ($setting['seo_on'] != 0) {
	$search_function = "searchSubmit('$setting[site_url]', '$setting[seo_extension]'); return false;";
}
else {
	$search_function = "this.submit();return false;";
}

// Make safe id
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
}

// Check and set referrer
if (isset($_GET['ref'])) {
	setcookie("wss_ref", $_GET['ref'], time()+60*60*24*100);
}
if (isset($_GET['r']) && !isset($_COOKIE['wss_lr'])) {
	$referer_id = intval($_GET['r']);
	mysql_query("UPDATE wss_links SET inbound = inbound + 1 WHERE id = $referer_id");
	setcookie("wss_lr", 1, time()+86400);	
} 

// Get search query
if (isset($_GET['q'])) {
	$search_val = htmlspecialchars($_GET['q']);
}
else {
	$search_val = SEARCH_DEFAULT;
}

if (($setting['site_offline'] == 0) || ($user['admin'] == 1)) {

	// Include the template
	if (file_exists('.'.$setting['template_url'].'/template_settings.php')) {
		// Include the template settings
		include '.'.$setting['template_url'].'/template_settings.php';
	
		// Include unique required files
		if (isset($_GET['task'])) {
			if ($_GET['task'] == 'view') {
				include('includes/wallpaper/wallpaper_main.inc.php');
			}
			else if ($_GET['task'] == 'profile') {
				include('includes/profile/profile_main.inc.php');
			}
			else if ($_GET['task'] == 'news') {
				include('includes/news/news_header.inc.php');
			}
			else if ($_GET['task'] == 'category') {
				include('includes/category/category_header.inc.php');
			}
			else if ($_GET['task'] == 'view_page') {
				if (isset($_GET['id'])) {
					$get_page_data = mysql_query("SELECT * FROM wss_pages WHERE id = $id");
				}
				else {
					$name = mysql_secure($_GET['name']);
					$get_page_data = mysql_query("SELECT * FROM wss_pages WHERE seo_url= '$name'");
				}
				$page = mysql_fetch_array($get_page_data);
			}
		}

		// Include the correct template page
		include '.'.$setting['template_url'].'/template_structure.php';
	}
	else {
		echo 'template_settings.php was not found in the template folder you specified'; 
	}
}
else {
	include ('includes/misc/site_offline.php');
}
?>