<?php
$template = array();

// Template Page Definitions
$template['homepage'] = 'pages/homepage.php';
$template['wallpaper'] = 'pages/wallpaper.php';
$template['category'] = 'pages/category.php';
$template['profile'] = 'pages/profile.php';
$template['misc'] = 'pages/misc.php';
$template['news'] = 'pages/news.php';

// Sections
$template['category_wallpaper'] = 'sections/category_wallpaper.php';
$template['search_wallpaper'] = 'sections/category_wallpaper.php';
$template['news_item'] = 'sections/news_item.php';
$template['home_cat'] = 'sections/homepage_category.php';

$template['featured_wallpaper'] = 'sections/featured_wallpaper.php';
$template['new_wallpaper'] = 'sections/new_wallpaper.php';

$template['home_wallpaper'] = 'sections/homepage_wallpaper.php';
$template['users_comments'] = 'sections/users_comments.php';
$template['wallpaper_comment'] = 'sections/wallpaper_comment.php';
$template['random_wallpaper'] = 'sections/random_wallpaper.php';
$template['favourite_wallpaper'] = 'sections/favourite_wallpaper.php';
$template['submitted_wallpaper'] = 'sections/submitted_wallpaper.php';
$template['news_comment'] = 'sections/news_comment.php';

$template['recent_wallpaper'] = 'sections/module_wallpaper.php';
$template['popular_module_wallpaper'] = 'sections/module_wallpaper.php';
$template['top_rated_module_wallpaper'] = 'sections/module_wallpaper.php';

// Optional forms. Allows you to create your own forms rather than using the defaults
//$template['edit_profile_form'] = 'edit_profile_form.php';
//$template['register_form'] = 'register_form.php';
//$template['login_form'] = 'login_form.php';
//$template['pm_form'] = 'pm_form.php';
//$template['lost_password_form'] = 'lost_password_form.php';

// Rating stars
$template['wallpaper_star'] = 'star.png';
$template['wallpaper_half_star'] = 'half_star.png';
$template['wallpaper_empty_star'] = 'empty_star.png';

$template['category_star'] = 'tiny_rating.png';
$template['category_half_star'] = 'tiny_rating_half.png';
$template['category_empty_star'] = 'tiny_rating_empty.png';

$template['homepage_star'] = 'tiny_rating.png';
$template['homepage_half_star'] = 'tiny_rating_half.png';
$template['homepage_empty_star'] = 'tiny_rating_empty.png';

$template['featured_star'] = 'tiny_rating.png';
$template['featured_half_star'] = 'tiny_rating_half.png';
$template['featured_empty_star'] = 'tiny_rating_empty.png';

// Highscore image
$template['highscore_image'] = '<img src="'.$setting['site_url'].'/images/trophy_smaller.png" />';

// Image sizes
$template['memberlist_avatar_width'] = '20px';
$template['memberlist_avatar_height'] = '20px';

// Wallpaper preview image sizes
	// Thumbnails - On this template all thumbails are the same size. Each variable can be set seperately though
	$template['preview_image'] = '600x338'; // Main image on the preview allpaper page
	$template['preview_image_43'] = '600x450'; // 4:3 aspect ratio preview image
	$template['submitted_thumbnail'] = 
	$template['featured_thumbnail'] =
	$template['category_thumbnail'] =
	$template['random_thumbnail'] =
	$template['new_thumbnail'] =
	$template['search_thumbnail'] =
	$template['home_cat_thumbnail'] = '180x102';

// Display settings
$template['category_columns'] = 2; // Number of wallpaper columns on the category page
$template['homepage_columns'] = 2; // Number of category columns on the homepage
$template['homepage_wallpaper_limit'] = 3; // Number of wallpapers to show per caregory on the homepage
$template['random_wallpaper_limit'] = 3; // Number of wallpapers to show in the random wallpapers section
$template['wallpapers_per_page'] = 30; // Number of wallpapers to show per page in categories

$template['submitted_wallpaper_limit'] = 6; // 1.1 - Number of submitted wallpapers to show per page on the profile page
$template['fav_wallpaper_limit'] = 6; // 1.1 - Number of favourite wallpapers to show per page on the profile page

$template['category_wallpaper_chars'] = 25; // The character limit for wallpaper names in categories
$template['category_wallpaper_desc_chars'] = 65; // The character limit for wallpaper descriptions in categories
$template['homepage_wallpaper_chars'] = 25; // The character limit for wallpaper names in categories
$template['homepage_wallpaper_desc_chars'] = 65; // The character limit for wallpaper descriptions in categories

$template['featured_wallpaper_chars'] = 25; // The character limit for wallpaper names in the featured wallpaper section
$template['featured_wallpaper_desc_chars'] = 65; // The character limit for wallpaper descriptions in the featured wallpaper section
$template['new_wallpaper_chars'] = 25; // The character limit for wallpaper names in the new wallpapers section
$template['new_wallpaper_desc_chars'] = 65; // The character limit for wallpaper descriptions in the new wallpapers section

$template['random_wallpaper_chars'] = 25; // The character limit for the random wallpaper names
$template['random_wallpaper_desc_chars'] = 110; // The character limit for the random wallpaper descriptions
$template['module_max_chars'] = 25; // The character limit modules (wallpaper names, news)
$template['player_module_max_chars'] = 20; // The character limit modules (wallpaper names, news)

$template['new_module_limit'] = '5'; // Number of wallpapers to show in the new wallpapers module
$template['popular_module_limit'] = '5'; // Number of wallpapers to show in the popular wallpapers module
$template['top_rated_module_limit'] = '5'; // Number of wallpapers to show in the popular wallpapers module

// Module Settings
$template['categories_menu_seperator'] = '</div><div class="category_menu_item">';
$template['user_menu_seperator'] = '&nbsp;&nbsp;&nbsp;';
$template['pages_menu_seperator'] = '</div><div class="menu_item">';
$template['secondary_menu_seperator'] = '';

// Advert placement descriptions
$template['advert_1'] = 'In the main header on all pages, next to the logo, suitable for a 468x60 advert';
$template['advert_2'] = 'Displayed on misc pages';
$template['advert_3'] = 'Displayed in the footer of all pages';
$template['advert_4'] = 'Displayed underneath the wallpaper preview image on the details page';
$template['advert_5'] = 'Displayed in user profiles';
$template['advert_6'] = 'Before the categories on the homepage';
$template['advert_7'] = 'Top of the category page, above the sort options';
$template['advert_8'] = 'Banner on the wallpaper preview page';

?>