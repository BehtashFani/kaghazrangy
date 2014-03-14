<?php include 'header.php';?>

<div class="secondary_container">
	<div class="left_sidebar">
		<?php include 'left_sidebar.php'; ?>
	</div>
	<div class="center_column">
		<div class="center_container">
			<div class="header_overflow"><h1><?php include 'includes/modules/breadcrumb.php';?></h1></div>
				
			<div class="wallpaper_preview">
				<?php echo $wallpaper['preview_image']; ?>
				<div class="resolutions_container">
					<?php include('./includes/wallpaper/resolutions.inc.php'); ?>
				</div>
			</div>
			
			<div class="ad_banner">
				<?php advert('advert_4'); ?>
			</div>
			
			<div class="wallpaper_options">
				<div class="option_float">
					<?php echo $wallpaper['report_wallpaper'];?>
				</div>
				<div class="option_float">
					<?php echo $wallpaper['fav_wallpaper'];?>
				</div>
				<?php if ($user['admin'] == 1) {?>
				<div class="option_float">
					<div id="editbutton">
						<?php echo $wallpaper['admin_options'];?>
					</div>
				</div>
				<?php } ?>
			</div>
			
			<h3><?php echo WALLPAPER_INFO;?></h3>
			<div class="wallpaper_info">
				<div class="wallpaper_info_left">
					<?php if ($wallpaper['submitter'] != 0) {?>
					<div class="info_item"><span class="info_item_title"><?php echo WALLPAPER_SUBMITTEDBY;?>;</span> <a href="<?php echo $submitter['url'];?>"><?php echo $submitter['username'];?></a></div>
					<?php } ?>
					<div class="info_item"><span class="info_item_title"><?php echo WALLPAPER_NAME;?>:</span> <?php echo $wallpaper['name'];?></div>
					<div class="info_item"><span class="info_item_title"><?php echo WALLPAPER_ADDED;?>:</span> <?php echo $wallpaper['date_added'];?></div>
					<?php if ($wallpaper['description'] != '') {?>
					<div class="info_item"><span class="info_item_title"><?php echo WALLPAPER_DESCRIPTION;?>:</span> <?php echo $wallpaper['description'];?></div>
					<?php } ?>
					<div class="info_item"><span class="info_item_title"><?php echo WALLPAPER_TAGS;?>:</span> <?php echo $wallpaper['tags'];?></div>
					<div class="info_item"><span class="info_item_title"><?php echo WALLPAPER_HITS;?>:</span> <?php echo $wallpaper['hits'];?> <span class="info_item_title"><?php echo WALLPAPER_DOWNLOADS;?>:</span> <?php echo $wallpaper['downloads'];?></div>
				</div>
				<div class="wallpaper_info_right">
					<?php echo '<div class="info_item_right">'.WALLPAPER_RATING.'<br />'.$wallpaper['rating_image'].'</div>';?>
					<?php echo '<div class="info_item_right">'.WALLPAPER_YOUR_RATING.'<br /> '.$wallpaper['new_rating_form'].'</div>';?>
					<?php include 'includes/wallpaper/social_icons.inc.php';?>
				</div>
			</div>
			
			<h1>
				<?php echo MORE_WALLPAPERS1.' '.$wallpaper['category_name'].' '.MORE_WALLPAPERS2;?>
			</h1>

			<div class="random_wallpapers">
				<?php include 'includes/wallpaper/random_wallpapers.inc.php';?>
			</div>
			
			<h1><?php echo WALLPAPER_COMMENTS;?></h1>
			<div class="wallpaper_comments">
				<?php include ('./includes/forms/add_comment_form.php'); // Include comment form ?>
				<?php include 'includes/wallpaper/wallpaper_comments.inc.php';?>
			</div>
			
		</div>
	</div>
</div>

<?php include 'footer.php';?>

