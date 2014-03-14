<script type="text/javascript">
<?php echo "
SITE_URL = '$setting[site_url]';
SEO_ON = '$setting[seo_on]';
COMMENT_WAIT = '".COMMENT_WAIT."';
COMMENT_ERROR = '".COMMENT_ERROR."';
WALLPAPER_SUBMIT_COMMENT = '".WALLPAPER_SUBMIT_COMMENT."';
ADDING_COMMENT = '".ADDING_COMMENT."';
COMMENT_ADDED = '".COMMENT_ADDED."';";

if (isset($_GET['task']) && $_GET['task'] == 'view')
	echo "window.setTimeout('WallpaperAddHit($id)', 1000);";
?>

function WallpaperAddHit(id) {
	AjaxPost("<?php echo $setting['site_url'];?>/includes/wallpaper/ajax/wallpaper_hit.php", "wallpaper_id="+id, 
			 function () {}
	)
}
</script>

<script type="text/javascript" src="<?php echo $setting['site_url'].'/includes/';?>wss.js"></script>
<link rel="alternate" type="application/rss+xml" title="<?php echo $setting['site_url'];?>" href="<?php echo $setting['site_url'];?>/rss.php" />

<?php 
include 'meta_data.php';
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="shortcut icon" href="<?php echo $setting['site_url'].'/favicon.png';?>" type="image/png" />
<link rel="icon" href="<?php echo $setting['site_url'].'/favicon.png';?>" type="image/png" />

<?php if ($setting['analytics_id'] != '') { ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $setting['analytics_id'];?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php } ?>