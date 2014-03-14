<?php 
echo '<title>';
// Task is set and has pages
if (isset($_GET['task']) && $_GET['task'] == 'category') {
	include('./includes/modules/content_title.php');
	if (isset($_GET['sortby'])) {
		$sort = secure($_GET['sortby']);
		echo ' - '.$sort_options[$sort];
	}
	if ($page > 1)
		echo ' - '.PAGE.' '.$page;
	echo ' - ';
}
elseif(isset($_GET['task']) && isset($page) && $page > 1 && $_GET['task'] != 'view_page') {
	include('./includes/modules/content_title.php'); 
	echo ' - '.PAGE.' '.$page." - ";
} 
// Task is set, no pages
elseif(isset($_GET['task'])) { 
	include('./includes/modules/content_title.php');
	echo ' - ';
} 

echo $setting['site_name'].'</title>';


if (isset($_GET['task']) && $_GET['task'] == 'view') {
	echo '<meta name="description" content="'.strip_tags($wallpaper['description']).'" />
	<meta name="KEYWORDS" content="'.$wallpaper_keywords.'" />
	<meta property="og:image" content="'.WallpaperPreview($row2['id'], $template['preview_image'], $template['preview_image_43'], $row2['filename'], $row2['seo_url'], $row2['display'], $wallpaper['file_extension'], $row2['original_width'], $row2['original_height']).'" />';
	
	$can_url = WallpaperUrl($wallpaper['id'], $wallpaper['seo_url'], $wallpaper['category']);
	echo '<link rel="canonical" href="'.$can_url.'" />';
}
else if (isset($_GET['task']) && $_GET['task'] == 'category') {
	$page_info = '';
	$sort_info = '';
	if (isset($page) && $page > 1) {
		$page_info = PAGE.' '.$page.' - ';
	}
	if (isset($_GET['sortby'])) {
		$sort = secure($_GET['sortby']);
		$sort_info = $sort_options[$sort].' - ';
	}
	if ($cat_info['description'] == '')
		$cat_info['description'] = $cat_info['name'];
	echo '<meta name="description" content="'.$cat_info['name'].' '.$sort_info.$page_info.shortenStr(strip_tags($cat_info['description']), 157).'" />
	<meta name="keywords" content="'.$cat_info['keywords'].'" />';
}
else if (isset($_GET['task']) && $_GET['task'] == 'view_page') {
	echo '<meta name="description" content="'.shortenStr(strip_tags($page['page']), 157).'" />
	<meta name="keywords" content="'.$page['meta_tags'].'" />';
}
else if (isset($_GET['task']) && $_GET['task'] == 'news' && (isset($_GET['id']) || isset($_GET['name']))) {
	echo '<meta name="description" content="'.shortenStr(strip_tags($news['content']), 157).'" />
	<meta name="keywords" content="'.$news['meta_tags'].'" />';
}
else {
	echo '<meta name="description" content="'.$setting['site_description'].'" />
	<meta name="keywords" content="'.$setting['site_keywords'].'" />';
}
?>