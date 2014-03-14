<?php include 'header.php';?>

<div class="secondary_container">
	<div class="left_sidebar">
		<?php include 'left_sidebar.php'; ?>
	</div>
	<div class="center_column">
		<div class="center_container">
			
			
			<div class="homepage_new">
				<h1><a href="<?php echo CategoryUrl(0, 'all', 1, 'newest');?>"><?php echo NEW_WALLPAPERS;?></a></h1>
				<?php include 'includes/homepage/new_wallpapers.inc.php'; ?>			
				<br style="clear:both" />
			</div>
			
			<div class="ad_banner_home">
				<?php advert('advert_6'); ?>
			</div>
		</div>
	</div>

	
			
</div>

<?php include 'footer.php';?>