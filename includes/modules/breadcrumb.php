<?php
if (isset($_GET["task"])) {

	echo '<a href="'.$setting['site_url'].'">'.HOMEPAGE.'</a> &raquo; ';
		
	if($_GET['task'] == 'edit_profile') {
		$profile_url = ProfileUrl($user['id'], $user['seo_url']);
		echo '<a href="'.$profile_url.'">'.$user['username'].'</a> &raquo; ';
	}
	
	else if(($_GET['task'] == 'category') && ($cat_info['parent_id'] != 0)) {
			$parent_url = CategoryUrl($cat_info['parent_id'], $parent_category['seo_url'], 1, 'newest');
			echo '<a href="'.$parent_url.'">'.$parent_category['name'].'</a> &raquo; ';
	}
		
	else if($_GET['task'] == 'news') {
		if (isset($_GET['id']) || isset($_GET['name'])) {
			if ($setting['seo_on'] != 0) {
				$news_url = '/news';
			}
			else {
				$news_url = '/index.php?task=news';
			}
			echo '<a href="'.$setting['site_url'].$news_url.'">'.NEWS.'</a>';
		}
		else {
			echo NEWS;
		}
		$nct = 1;
	}
	else if($_GET['task'] == 'view') {
		if ($category['parent_id'] != 0) {
			$parent_url = CategoryUrl($parent_category['id'], $parent_category['seo_url'], 1, 'newest');
			echo '<a href="'.$parent_url.'">'.$parent_category['name'].'</a> &raquo; ';
		}
	
		$category_url = CategoryUrl($category['id'], $category['seo_url'], 1, 'newest');
		echo '<a href="'.$category_url.'">'.$category['name'].'</a> &raquo; ';
	} 
}

if(!isset($nct))
	include 'content_title.php';
?>
