<?php include 'header.php';?>

<div class="secondary_container">
	<div class="left_sidebar">
		<?php include 'left_sidebar.php'; ?>
	</div>
	<div class="right_sidebar">
		<?php include 'right_sidebar.php'; ?>
	</div>
	<div class="center_column">
		<div class="center_container">
			<div class="header_overflow"><h1><?php include 'includes/modules/breadcrumb.php';?></h1></div>
				
			<div class="profile_header">
				<img src="<?php echo $profile['avatar_url'];?>" alt="Avatar" width="75" height="75" class="profile-header_avatar_img"/><br />
				<div class="profile_username"><?php echo $profile['name'];?></div>
				<div class="profile_pm_button"><?php echo $profile['button1'];?></div>
			</div>	
				
			<div class="profile_info">
				<div class="left">
					<span class="right_title"><?php echo PROFILE_JOINED;?>:</span> <?php echo $profile['join_date'];?><br />
					<span class="right_title"><?php echo PROFILE_LOCATION;?>:</span> <?php echo $profile['location'];?><br />
					<span class="right_title"><?php echo PROFILE_BIO;?>:</span> <?php echo $profile['about'];?><br />
				</div>
				<div class="right">
				<span class="right_title"><?php echo PROFILE_LAST_ACTIVITY;?>:</span> <?php echo $profile['last_activity'];?><br />
				<span class="right_title"><?php echo PROFILE_WEBSITE;?>:</span> <?php echo $profile['website_link'];?><br />
				<span class="right_title"><?php echo EP_INTERESTS;?>:</span> <?php echo $profile['interests'];?><br />
				</div>
			</div>
			
			<div class="ad_banner_profile">
				<?php advert('advert_5'); ?>
			</div>
			
			<h3><?php echo PROFILE_UPLOADED_WALLPAPERS;?></h3>
			<div class="profile_wallpapers_container">
				<?php include 'includes/profile/submitted_wallpapers.inc.php';?>
			</div>
			<h1><?php echo PROFILE_FAV_WALLPAPERS;?></h1>
			<div class="profile_wallpapers_container">
				<?php include 'includes/profile/fav_wallpapers.inc.php';?>
			</div>
			
		</div>
	</div>
</div>

<?php include 'footer.php';?>