<?php include 'header.php';?>

<div class="secondary_container">
	<div class="left_sidebar">
		<?php include 'left_sidebar.php'; ?>
	</div>
	<div class="center_column">
		<div class="center_container">
			<div class="header_overflow"><h1><?php include 'includes/modules/breadcrumb.php';?>
			 <?php echo $news['rss_icon'];?></h1></div>
			<div class="ad_banner_misc">
				<?php advert('advert_2'); ?>
			</div>
			<img src="templates\darkbrush\images\newsicon.png" width="45" height="45" />
			<?php include './includes/news/news_main.inc.php'; ?>
	
		
		<?php if (isset($_GET['id']) || isset($_GET['name'])) {
			echo '<div class="news_comments_container">
			<h1>'.NEWS_COMMENTS.'</h1>
			<div align="center">';
			include ('./includes/forms/add_news_comment_form.php');
			echo '</div>';
			include ('./includes/news/news_comments.inc.php');
			echo '</div>';
		}
	?>
			
		</div>
	</div>
</div>

<?php include 'footer.php';?>