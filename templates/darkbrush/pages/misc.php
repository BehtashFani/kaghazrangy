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
			<div class="ad_banner_misc">
				<?php advert('advert_2'); ?>
			</div>
				
			<?php include 'includes/misc/misc.inc.php';?>
		
		</div>
	</div>
</div>

<?php include 'footer.php';?>