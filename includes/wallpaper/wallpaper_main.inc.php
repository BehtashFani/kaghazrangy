<?php
// This file is included by Wallpaper Site Script and should not be included in the template file

defined( 'WSS_' ) or die( '' );

// Get by id or seo_name depending on SEO setting
if (isset($_GET['name'])) {
	$seo_url = mysql_secure($_GET['name']);
	$wallpaper_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE seo_url = '$seo_url' AND published=1"),0);
}
else {
	$wallpaper_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE id= '$id' AND published=1"),0);
}
	
if ($wallpaper_exists == 0) {
	// Wallpaper not found
	header('Location: '.$setting['site_url'].'/index.php?task=pnf');
}

if (isset($_GET['name'])) {
	$sql = mysql_query("SELECT * FROM wss_wallpapers WHERE seo_url = '$seo_url'");
}
else {
	$sql = mysql_query("SELECT * FROM wss_wallpapers WHERE id = $id");
}
$row2 = mysql_fetch_array($sql);
$id = $row2['id'];
	
// Define 'wallpaper' array for usage in the view wallpaper template
$wallpaper = WallpaperData($row2, 'wallpaper');

// Support for non-updated templates
if (!isset($template['preview_image_43'])) {
	$template['preview_image_43'] = $template['preview_image'];
}

$wallpaper['preview_image'] = '<img src="'.WallpaperPreview($row2['id'], $template['preview_image'], $template['preview_image_43'], $row2['filename'], $row2['seo_url'], $row2['display'], $wallpaper['file_extension'], $row2['original_width'], $row2['original_height']).'" alt="'.$wallpaper['name'].'" />';

$wallpaper['date_added'] = FormatDate($row2['date_added'], 'date');
		
// Favourite wallpaper button
if ($user['login_status'] == 1) {
	$user_fav_yet = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_favourites WHERE user_id='$user[id]' AND wallpaper_id='$id'"), 0);
	if ($user_fav_yet >= 1) {
		$wallpaper['fav_wallpaper'] = '<div id="favbutton"><a href="#" onclick="AddFav('.$row2['id'].', 1,\''.$setting['site_url'].'\', \''.WALLPAPER_UNFAVOURITE.'\', \''.WALLPAPER_FAVOURITE.'\' ); return false">'.WALLPAPER_UNFAVOURITE.'</a></div>';
	}
	else {
		$wallpaper['fav_wallpaper'] = '<div id="favbutton"><a href="#" onclick="AddFav('.$row2['id'].', 0,\''.$setting['site_url'].'\', \''.WALLPAPER_UNFAVOURITE.'\', \''.WALLPAPER_FAVOURITE.'\'); return false">'.WALLPAPER_FAVOURITE.'</a></div>';
	}
}
else {
	$wallpaper['fav_wallpaper'] = '<div id="favbutton"><a href="'.$setting['site_url'].'/index.php?task=login">'.LOGIN.'</a></div>';
}

// Report wallpaper button
	if ($setting['report_permissions'] == "1" || $setting['report_permissions'] == "2" && $user['login_status'] == 1) { 
		$wallpaper['report_wallpaper'] = '<div id="reportwallpaper"><a href="#" onclick="ShowPopup(\'ava-popup\', \''.$setting['site_url'].'/includes/forms/wallpaper_report_form.php?id='.$row2['id'].'\', \''.WALLPAPER_REPORT.'\'); return false">'.WALLPAPER_REPORT.'</a></div>';
	}
		
// Define the 'new rating' section for the template
if(isset($_COOKIE["wss_username"]))
{
	$user_rated_yet = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_ratings WHERE user_id='$user[id]' AND wallpaper_id='$id'"), 0);
	if ($user_rated_yet >= 1) {
		$ur = mysql_query("SELECT * FROM wss_ratings WHERE wallpaper_id=$id AND user_id='$user[id]'");
		$user_rating = mysql_fetch_array($ur);
			
		$wallpaper['new_rating_form'] = GenerateRating($user_rating['rating'], 'wallpaper');
	}
	else {
		$wallpaper['new_rating_form'] = '<div id="rateMe" title="Rate Me...">
    	<a onclick="rateIt(this, '.$id.", '".$setting['site_url']."'".')" id="_1" title="1" onmouseover="rating(this)" onmouseout="off(this)"></a>
    	<a onclick="rateIt(this, '.$id.", '".$setting['site_url']."'".')" id="_2" title="2" onmouseover="rating(this)" onmouseout="off(this)"></a>
    	<a onclick="rateIt(this, '.$id.", '".$setting['site_url']."'".')" id="_3" title="3" onmouseover="rating(this)" onmouseout="off(this)"></a>
    	<a onclick="rateIt(this, '.$id.", '".$setting['site_url']."'".')" id="_4" title="4" onmouseover="rating(this)" onmouseout="off(this)"></a>
    	<a onclick="rateIt(this, '.$id.", '".$setting['site_url']."'".')" id="_5" title="5" onmouseover="rating(this)" onmouseout="off(this)"></a>
		</div>';
	}
}
else {
	$wallpaper['new_rating_form'] = WALLPAPER_LOGIN_TO_RATE;
}

$wallpaper['tags'] = TagList($row2['id'], "&nbsp; ", 1);

if ($wallpaper['tags'] == '') {
	$wallpaper['tags'] = NO_TAGS;
}

// Get the category name
$cat_sql = mysql_query("SELECT * FROM wss_cats WHERE id = $wallpaper[category]");
$category = mysql_fetch_array($cat_sql);

if ($category['parent_id'] != 0) {
	$pcat_sql = mysql_query("SELECT * FROM wss_cats WHERE id = $category[parent_id]");
	$parent_category = mysql_fetch_array($pcat_sql);
}

$wallpaper['category_name'] = $category['name'];
$wallpaper['submitter'] = $row2['submitter'];

if ($wallpaper['submitter'] != 0) {
	$submitter_sql = mysql_query("SELECT * FROM wss_users WHERE id = $wallpaper[submitter]");
	$submitter = mysql_fetch_array($submitter_sql);
	
	$submitter['url'] = ProfileUrl($submitter['id'], $submitter['seo_url']);
}
	
// If admin is logged in, show admin options
if($user['admin'] == 1) {
	$wallpaper['admin_options'] = '<a href="'.$setting['site_url'].'/admin/?task=manage_wallpapers#id='.$id.'">'.EDIT_WALLPAPER.'</a>';
}
else {
	$wallpaper['admin_options'] = '';
}

// Update the previously viewed cookie
	if (isset($_COOKIE['wss_previouslyviewed'])) {
		$pv_cookie = mysql_secure($_COOKIE['wss_previouslyviewed']);
	}
	else {
		$pv_cookie = '';
	}

	$previously_viewed = explode(',', $pv_cookie);
	$i = 0;
	foreach ($previously_viewed as $pv) {
		if ($pv == $id) {
			$already_exists = 1;
		}
		$i++;
	}
	if (!isset($already_exists)) {
	
		if ($i >= 5) {
			$updated_cookie = substr($pv_cookie, ($pos = strpos($pv_cookie, ',')) !== false ? $pos + 1 : 0);
		}
		else {
			$updated_cookie = $pv_cookie;
		}
		$updated_cookie .= $id.',';
		setcookie("wss_previouslyviewed", $updated_cookie, time()+60*60*24*100, '/');
		$user['previously_viewed'] = $updated_cookie;
	}
?>