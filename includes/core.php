<?php
// The resolutions list

function resolutionsList() {
	include 'resolutions.php';
	return $resolutions;
}

// Make a string SEO friendly
function seoname($name) {
	global $language_char_conversions, $originals, $replacements;
	if ((isset($language_char_conversions)) && ($language_char_conversions == 1)) {
		$search = explode(",", $originals);
		$replace = explode(",", $replacements);
		$name = str_replace($search, $replace, $name);
	}
	$name = stripslashes($name);
	$name = strtolower($name);
	$name = str_replace("&", "and", $name);
	$name = str_replace(" ", "-", $name);
	$name = str_replace("---", "-", $name);
	$name = str_replace("/", "-", $name);
	$name = str_replace("?", "", $name);
	$name = preg_replace( "/[\.,\";'\:]/", "", $name );
	//$name = urlencode($name);
	return $name;
}

// Mysql escape/secure function
function mysql_secure($string) {
		$string = strip_tags($string);
		$string = htmlspecialchars($string);
		$string = trim($string);
		if (get_magic_quotes_gpc()) {
			$string = stripslashes($string);
		}
		$string = mysql_real_escape_string($string);
	return $string;
}

// General escape/secure function
function secure($string) {
	$string = strip_tags($string);
	$string = htmlspecialchars($string);
	$string = trim($string);
	if (get_magic_quotes_gpc()) {
		$string = stripslashes($string);
	}
	return $string;
}

// Check if user is admin function
function user_is_admin() {
	if(isset($_COOKIE["wss_username"]))	{
		$user = $_COOKIE['wss_username'];
		$code = $_COOKIE['wss_code'];
		$userid = intval($_COOKIE['wss_userid']);
		$code2 = preg_replace("/[^a-z,A-Z,0-9]/", "", $code);
		
		$sql = mysql_query("SELECT * FROM wss_users WHERE id='$userid' AND password='$code2' AND admin='1'");
		$login_check = mysql_num_rows($sql);
		if($login_check <= 0) {
			return(FALSE);
		}
		else {
			return(TRUE);
		}
	}
	else {
		return(FALSE);
	}
}

// Generate a 5 star rating image
function GenerateRating($rating, $location) {
global $setting, $template;
		
	if ($location == 'wallpaper') {
		$empty_star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['wallpaper_empty_star'].'" alt="Rating star" />';
		$half_star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['wallpaper_half_star'].'" alt="Rating star" />';
		$star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['wallpaper_star'].'" alt="Rating star" />';
	}
	else if ($location == 'category') {
		$empty_star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['category_empty_star'].'" alt="Rating star" />';
		$half_star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['category_half_star'].'" alt="Rating star" />';
		$star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['category_star'].'" alt="Rating star" />';
	}
	else if ($location == 'homepage') {
		$empty_star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['homepage_empty_star'].'" alt="Rating star" />';
		$half_star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['homepage_half_star'].'" alt="Rating star" />';
		$star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['homepage_star'].'" alt="Rating star" />';
	}
	else {
		$empty_star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['featured_empty_star'].'" alt="Rating star" />';
		$half_star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['featured_half_star'].'" alt="Rating star" />';
		$star = '<img src="'.$setting['site_url'].$setting['template_url'].'/images/'.$template['featured_star'].'" alt="Rating star" />';
	}

	
	if ($rating <= 0  ){$rating_images = $empty_star.$empty_star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 0.5){$rating_images = $half_star.$empty_star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 1  ){$rating_images = $star.$empty_star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 1.5){$rating_images = $star.$half_star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 2  ){$rating_images = $star.$star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 2.5){$rating_images = $star.$star.$half_star.$empty_star.$empty_star;}
	if ($rating >= 3  ){$rating_images = $star.$star.$star.$empty_star.$empty_star;}
	if ($rating >= 3.5){$rating_images = $star.$star.$star.$half_star.$empty_star;}
	if ($rating >= 4  ){$rating_images = $star.$star.$star.$star.$empty_star;}
	if ($rating >= 4.5){$rating_images = $star.$star.$star.$star.$half_star;}
	if ($rating >= 5  ){$rating_images = $star.$star.$star.$star.$star;}
	
	return $rating_images;
// Get rating END
}

// Advert function
function advert($position) {
	global $setting;

	if ($setting['adverts'] == 1) {
		$ad = $setting[$position];
		if ($ad != 0) {
			$get_ad = mysql_fetch_array(mysql_query("SELECT ad_content FROM wss_adverts WHERE id = $ad"));
			echo $get_ad['ad_content'];
			//echo $position;
		}
	}
}

// Shorten string function (thanks elkwallpapers)
function shortenStr ($str, $len) {
    return strlen($str) > $len ?  substr($str, 0, $len)."…" : $str;
}

// Format date & time from Mysql format to readable format
function FormatDate($str, $depth) {
	global $setting;
	$str = intval($str);
	if ($depth == 'time') {
		if ($str != '0') {
			$s = date($setting['date_format'].", H:i", $str);
		}
		else {
			$s = DATE_UNKNOWN;
		}
	}
	else if ($depth == 'short') {
		if ($str != '0') {
			$s = date($setting['date_format'], $str);
		}
		else {
			$s = DATE_UNKNOWN;
		}
	}
	else if ($depth == 'admin_date') {
		if ($str != '0') {
			$s = date($setting['date_format'], $str);
		}
		else {
			$s = 'No record';
		}
	}
	else if ($depth == 'admin_datetime') {
		if ($str != '0') {
			$s = date($setting['date_format'].', H:i', $str);
		}
		else {
			$s = 'No record';
		}
	}
	else {
		if ($str != '0') {
			$s = date($setting['date_format'], $str);
		}
		else {
			$s = DATE_UNKNOWN;
		}
	}
	return $s;
}

// Generate wallpaper URL function
function WallpaperUrl($id, $seo_name, $cat_id) {
	global $setting;
		
	if ($setting['seo_on'] == 0) {
		$url = $setting['site_url'].'/index.php?task=view&amp;id='.$id;
	}
	else if ($setting['seo_on'] == 2) {
		$cat_name = mysql_fetch_array(mysql_query("SELECT name FROM wss_cats WHERE id=$cat_id"));
		$seo_cat_name = seoname($cat_name['name']);
		$url = $setting['site_url'].'/'.$seo_cat_name.'/'.$id.'/'.$seo_name.$setting['seo_extension'];
	}
	else if ($setting['seo_on'] == 3) {
		$cat_name = mysql_fetch_array(mysql_query("SELECT name FROM wss_cats WHERE id=$cat_id"));
		$seo_cat_name = seoname($cat_name['name']);
		$url = $setting['site_url'].'/'.$seo_cat_name.'/'.$seo_name.$setting['seo_extension'];
	}
	return $url;
}

// Generate wallpaper thumbnail URL function
function WallpaperThumbnail($data, $width, $height, $add_url = '') {
	global $setting;

	$check_url = 'imagecache/thumbnails/'.$data['id'].'/'.$width.'x'.$height.'.png';
	
	if (file_exists($add_url.$check_url)) {
		$url = $check_url;
	}
	else {
		$url = 'image.php?width='.$width.'&height='.$height.'&id='.$data['id'].'&nocache=1&dothumb=1';
	}
	
	return $setting['site_url'].'/'.$url;
}

// Generate wallpaper thumbnail URL function
function WallpaperPreview($id, $dimensions, $dimensions_43, $filename, $name, $crop_align, $ext, $orignal_width, $orignal_height) {
	
	$dimensions_ar = explode('x', $dimensions);
	$gcd = AspectRatio($orignal_width, $orignal_height);
	$a = $orignal_width/$gcd;  
	$b = $orignal_height/$gcd;  
	$ratio = $a . ":" . $b;  
	
	if ($ratio == '4:3') {
		$dimensions = $dimensions_43;
	}

	global $setting;
	if ($setting['seo_on'] != 0) {
		$url = '/file/'.$id.'/'.$dimensions.'/16:9/'.$name.'_'.$filename.'.'.$ext;
	}
	else {
		$dimensions_ar = explode('x', $dimensions);
		$url = '/image.php?id='.$id.'&width='.$dimensions_ar[0].'&height='.$dimensions_ar[1].'&cropratio=16:9&cropposition='.$crop_align.'&filename='.$filename;
	}
	return $setting['site_url'].$url;
}

// Generate profile URL function
function ProfileUrl($id, $seo_name) {
	global $setting;

	if ($setting['seo_on'] == 0) {
		$url = 'index.php?task=profile&amp;id='.$id;
	}
	else if ($setting['seo_on'] == 3) {
		$url = 'profile/'.$seo_name.$setting['seo_extension'];
	}
	else {
		$url = 'profile/'.$id.'/'.$seo_name.$setting['seo_extension'];
	}
	return $setting['site_url'].'/'.$url;
}

// Generate avatar URL function
function AvatarUrl($avatar_url, $facebook, $facebook_id) {
	global $setting;
	if($avatar_url == '') { 
		if ($facebook == 1) {
			$avatar = 'http://graph.facebook.com/'.$facebook_id.'/picture';
		}
		else {
			$avatar = $setting['site_url'].'/uploads/avatars/default.png';
		}
	}
	else {
		$avatar = $setting['site_url'].'/uploads/avatars/'.$avatar_url;
	}
	return $avatar;
}

// Generate news URL function
function NewsUrl($id, $seo_title) {
	global $setting;
	
	if ($setting['seo_on'] == 0) {
		$url = '/index.php?task=news&amp;id='.$id;
	}
	else if ($setting['seo_on'] == 3) {
		$url = '/news/'.$seo_title.$setting['seo_extension'];
	}
	else {
		$url = '/news/item/'.$id.'/'.$seo_title.$setting['seo_extension'];
	}

	return $setting['site_url'].$url;
}

function NewsPagesUrl($page) {
	global $setting;
	
	if ($setting['seo_on'] == 0) {
		$url = '/index.php?task=news&page='.$page;
	}
	else {
		$url = '/news/page'.$page.$setting['seo_extension'];
	}
	
	return $setting['site_url'].$url;
}

// Generate category URL function
function CategoryUrl($id, $seo_name, $page, $sortby) {
	global $setting;
		
	if (!isset($sortby))
		$sortby = 'newest';
	
	if ($setting['seo_on'] == 0) {
		$url = $setting['site_url'].'/index.php?task=category&amp;id='.$id.'&sortby='.$sortby.'&page='.$page;
	}
	else if ($setting['seo_on'] == 2) {
		$url = $setting['site_url'].'/cat/'.$id.'/'.$seo_name.'/'.$sortby.'-'.$page.$setting['seo_extension'];
	}
	else if ($setting['seo_on'] == 3) {
		if (($page == 1) && ($sortby == 'newest')) {
			$url = $setting['site_url'].'/'.$seo_name.$setting['seo_extension'];
		}
		else {
			$url = $setting['site_url'].'/'.$seo_name.'/'.$sortby.'/'.$page.$setting['seo_extension'];
		}
	}
	
	return $url;
}

function TagUrl($tag, $page, $sort) {
	global $setting;
	
	if (!isset($sort))
		$sort = 'newest';
	
	$tag = seoname($tag);

	if (($page == 1) && ($sort == 'newest')) {
		if ($setting['seo_on'] == 0) {
			$tag_link = '/index.php?task=tag&t='.$tag;
		}
		else {
			$tag_link = '/tag/'.$tag.$setting['seo_extension'];	
		}
	}
	else {
		if ($setting['seo_on'] == 0) {
			$tag_link = '/index.php?task=tag&t='.$tag.'&sortby='.$sort.'&page='.$page;
		}
		else {
			$tag_link = '/tag/'.$tag.'/'.$sort.'/'.$page.$setting['seo_extension'];	
		}
	}
	
	return $setting['site_url'].$tag_link;
}

function PreviewUrl($resolution) {
	global $setting, $wallpaper;
	
	if ($setting['seo_on'] != 0)
		$url = $setting['site_url'].'/preview/'.$wallpaper['id'].'/'.$resolution.'/'.$wallpaper['seo_url'].$setting['seo_extension'];
	else {
		$dimensions = explode('x', $resolution);
		$url = $setting['site_url'].'/wallpaper_preview.php?id='.$wallpaper['id'].'&width='.$dimensions[0].'&height='.$dimensions[1].'&crop='.$wallpaper['display'].'&download=1';
	}
		
		return $url;
}

// Generate member list URL
function MemberListUrl($sort, $order, $page) {
	global $setting;
	
	if ($setting['seo_on'] == 0) {
		$url = $setting['site_url'].'/index.php?task=member_list&sort='.$sort.'&order='.$order.'&page='.$page;
	}
	else {
		$url = $setting['site_url'].'/members/'.$sort.'-'.$order.'/page'.$page.$setting['seo_extension'];
	}
	
	return $url;
	
}

// Generate a short referal url
function ShortUrl($id) {
	global $setting, $user;
	
	if ($user['login_status'] == 1) {
		if ($setting['seo_on'] == 0) {
			$url = '/go.php?id='.$id.'&ref='.$user['id'];
		}
		else {
			$url = '/r-'.$id.'-'.$user['id'];
		}
	}
	else {
		if ($setting['seo_on'] == 0) {
			$url = '/go.php?id='.$id;
		}
		else {
			$url = '/r-'.$id;
		}	
	}
	
	return $setting['site_url'].$url;
}

// Generate the list of tags for a wallpaper
function TagList($id, $spacer, $link) {
	global $setting, $wallpaper_keywords, $lang_tags_id;
	$tags = mysql_query("
	SELECT *
	FROM wss_tag_relations bt, wss_tags t
	WHERE bt.tag_id = t.id
	AND bt.wallpaper_id = $id
	GROUP BY bt.id
	") or die (mysql_error());

	$tag_list = '';
	$tag_no = 0;

	while($get_tags = mysql_fetch_array($tags)) {
	
		$tag_link = TagUrl($get_tags['seo_url'], 1, 'newest');
		
		if ($tag_no == 1) {
			if ($link == 1) {
				$tag_list = $tag_list.$spacer.'<a href="'.$tag_link.'">'.$get_tags['tag_name'].'</a>';
				$wallpaper_keywords = $wallpaper_keywords.','.$get_tags['tag_name'];
			}
			else {
				$tag_list = $tag_list.$spacer.$get_tags['tag_name'];
			}
		}
		else {
			if ($link == 1) {
				$tag_list = $tag_list.'<a href="'.$tag_link.'">'.$get_tags['tag_name'].'</a>';
				$wallpaper_keywords = $wallpaper_keywords.$get_tags['tag_name'];
			}
			else {
				$tag_list = $tag_list.$get_tags['tag_name'];
			}
			
			$tag_no = 1;
		}
	}
	return $tag_list;
}

function categorylist($selected) {
	$cq = mysql_query("SELECT * FROM wss_cats ORDER BY cat_order ASC");
	while($ca = mysql_fetch_array($cq)) {
		if ($ca['id'] == $selected) {
			echo '<option value="'.$ca['id'].'" selected>'; 
		}
		else {
			echo '<option value="'.$ca['id'].'">';
		}
		if ($ca['parent_id'] != 0) {
			echo ' &nbsp; &nbsp;';
		}
		echo $ca['name'].'</option>'; 
   	}
}

function WallpaperData($raw_data, $type) {
	global $setting, $template, $user;
	
	$wallpaper = array('id' => $raw_data['id'], 'name' => $raw_data['name'], 'description' => $raw_data['description'],  'seo_url' => $raw_data['seo_url'],  'category' => $raw_data['category'],  'align' => $raw_data['align'],  'seo_url' => $raw_data['seo_url'], 'display' => $raw_data['display'], 'file' => $raw_data['file'], 'hits' => $raw_data['hits'], 'downloads' => $raw_data['downloads'], 'original_width' => $raw_data['original_width'], 'original_height' => $raw_data['original_height']);
	if (isset($template[$type.'_wallpaper_chars'])) {
		$wallpaper['name'] = shortenStr($raw_data['name'], $template[$type.'_wallpaper_chars']);
	}
	else {
		$wallpaper['name'] = $raw_data['name'];
	}
	
	if (isset($template[$type.'_wallpaper_desc_chars'])) {
		$wallpaper['description'] = shortenStr($raw_data['description'], $template[$type.'_wallpaper_desc_chars']);
	}
	else {
		$wallpaper['description'] = $raw_data['description'];
	}
		
	$wallpaper['thumbnail'] = WallpaperThumbnail($raw_data, '180', '102');
	
	$wallpaper['url'] = WallpaperUrl($raw_data['id'], $raw_data['seo_url'], $raw_data['category']);
	
	$wallpaper['date_added'] = FormatDate($raw_data['date_added'], 'date');
	
	$wallpaper['rating'] = $wallpaper['rating_image'] = GenerateRating($raw_data['rating'], $type);
	
	$wallpaper['file_extension'] = substr($raw_data['file'], strrpos($raw_data['file'], '.') + 1);
	
	if ($user['admin'] == 1) { 
		$wallpaper['admin_edit'] = '<a href="'.$setting['site_url'].'/admin/?task=manage_wallpapers#id='.$raw_data['id'].'">Edit</a>';
	}
	else {
		$wallpaper['admin_edit'] = '';
	}
	
	return $wallpaper;
}

function SendEmail($data, $template) {
	global $setting;

	if (1 == 1) {
			
		include "templates/email_templates/default/$template.php";
		$from = $setting['admin_email'];
		$headers = 'From: '.$setting['site_name'].' <' . $from . ">\r\n" .
    				'Reply-To: ' . $from . "\r\n" .
    				'X-Mailer: PHP/' . phpversion() . "\r\n" . 
    				'MIME-Version: 1.0' . "\r\n" . 
    				'Content-type: text/html; charset=utf-8\r\n' . "\r\n";
    			
		mail($data['email_address'], $data['subject'], $message, $headers);
	}
}

function SendPM($subject, $message, $to_user_id) {
	global $setting, $user;

	$date = time();

	mysql_query("INSERT INTO wss_messages (user_id, sender_id, sender_name, title, message, date, ip) 
				VALUES ('$to_user_id', '$user[id]', '$user[username]', '$subject', '$message', '$date', '$_SERVER[REMOTE_ADDR]')") or die (mysql_error());
				
	// Update user messages counter
	mysql_query("UPDATE wss_users SET messages = messages + 1 WHERE id = $to_user_id") or die (mysql_error());
	
	// Update last_pm value
	mysql_query("UPDATE wss_users SET last_pm = '$date' WHERE id = $user[id]") or die (mysql_error());
}


function AspectRatio($a, $b) {  
	while ($b != 0) {
		$remainder = $a % $b;  
		$a = $b;  
		$b = $remainder;  
	}  
	return abs ($a);  
}  
?>