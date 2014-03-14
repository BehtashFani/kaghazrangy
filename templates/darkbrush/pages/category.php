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
				<?php advert('advert_7'); ?>
			</div>
			
			<div class="category_sort_options">
				<?php if ($cat_info['total_subcats'] != 0) {
						echo '<div class="category_subcats">'.CATEGORY_SUBCATS.': '; include 'includes/category/sub_categories.inc.php'; echo '</div>';
					}
				
					echo CATEGORY_SORT_BY.': '; include 'includes/category/sort_options.inc.php';
					echo ' &nbsp; ';
					include 'includes/category/resolutions_filter.inc.php';
				?>
			</div>
			
			<div class="category_container">
				<?php include 'includes/category/category_main.inc.php';?>
			</div>
			
			<div class="category_pages">
				<?php include 'includes/category/pages.inc.php';?>
			</div>
			
		</div>
	</div>
</div>

<?php include 'footer.php';?>