<?php
defined( 'WSS_' ) or die( '' );

if (isset($_GET['name'])) {
	$seo_url = mysql_secure($_GET['name']);
	$sql = mysql_query("SELECT * FROM wss_users WHERE seo_url='".$seo_url."'");
}
else {
	$sql = mysql_query("SELECT * FROM wss_users WHERE id='".$id."'");
}

$user_exists = mysql_num_rows($sql);
if ($user_exists != 1) {
	header("HTTP/1.0 404 Not Found");
	include 'includes/misc/404.php';
	exit();
}

$row = mysql_fetch_array($sql);
$profile = array();
$profile['name'] = $row['username'];
$id = $row['id'];


if ($row['location'] == '') {
	$profile['location'] = PROFILE_NO_INFO;
}
else {
	$profile['location'] = $row['location'];
}
if ($row['website'] == '') {
	$profile['website'] = PROFILE_NO_INFO;
}
else {
	$profile['website'] = $row['website'];
}
if ($row['website'] == '') {
	$profile['website_link'] = PROFILE_NO_INFO;
}
else {
	$profile['website_link'] = '<a href="'.$row['website'].'">'.$row['website'].'</a>';
}
if ($row['about'] == '') {
	$profile['about'] = PROFILE_NO_INFO;
}
else {
	$profile['about'] = $row['about'];
}
if ($row['interests'] == '') {
	$profile['interests'] = PROFILE_NO_INFO;
}
else {
	$profile['interests'] = $row['interests'];
}
if ($row['avatar'] == '') {
	if ($row['facebook'] == 1) {
		$profile['avatar_url'] = 'http://graph.facebook.com/'.$row['facebook_id'].'/picture';
	}
	else {
		$profile['avatar_url'] = $setting['site_url'].'/uploads/avatars/default.png';
	}
}
else {
	$profile['avatar_url'] = $setting['site_url'].'/uploads/avatars/'.$row['avatar'];
}

$profile['comments'] = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_comments WHERE user=$id"),0);
$profile['id'] = $row['id'];
$profile['comments'] = $row['comments'];
$profile['ratings'] = $row['ratings'];
$profile['join_date'] = FormatDate($row['joined'], 'all');
$profile['last_activity'] = FormatDate($row['last_activity'], 'all');
$profile['favourites'] = $row['favourites'];

if ($id == $_COOKIE['wss_userid']) 
{
  $profile['button1'] = '<a href="'.$setting['site_url'].'/index.php?task=edit_profile">'.PROFILE_EDIT.'</a>';
}
else 
{ 
 $profile['button1'] = '<a href="'.$setting['site_url'].'/index.php?task=send_message&amp;id='.$id.'">'.PROFILE_SEND_MESSAGE.'</a>';
}

// If admin is logged in, show admin options
if($user['admin'] == 1) {
	$profile['admin_edit'] = '<a href="'.$setting['site_url'].'/admin/?task=manage_users#id='.$id.'">Edit user</a>';
}
else {
	$profile['admin_edit'] = '';
}
?>

