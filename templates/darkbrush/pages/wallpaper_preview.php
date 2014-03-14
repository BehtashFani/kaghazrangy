<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?php echo $wallpaper['name'].' - '.$width.'x'.$height;?></title>
	<style type="text/css">
		body {
			margin: 0px;
			padding: 0px;
			color: #fff;
			width: 960px auto;
			font-family: tahoma;
			background-color: #F8E9C0;
		}
		.preview_wallpaper_header {
			direction: rtl;
			padding-top: 10px;
			margin-right: 20px;
			padding-bottom: 10px;
			border-bottom:4px solid #FFF;
			width: 100%;
			background-color: #E4655F;
		}
		.preview_wallpaper_left {
			padding-right: 10px;
		}
		.preview_wallpaper_right {
			margin-left: 8px;
		}
		.preview_wallpaper_right_short {
			margin-top: 20px;
			text-align: center;
		}
		.preview_wallpaper_name {
			font-size: 20px;
			text-shadow: #000 0px 1px 0px;
		}
		.preview_wallpaper_name a {
			color: #FFF;
			text-align: center;
			text-decoration: none;
		}
		.preview_wallpaper_name a:hover {
			text-decoration: underline;
		}
		.preview_wallpaper_info {
			margin-top: 20px;
			color: #FFF;
			font-size: 20px;
		}
		.preview_wallpaper_info a {	display: block;
			border : none;
		    font: 26px Arial;
		    text-align: center;
		    text-decoration: none;
		    margin: 20px 0px 20px 20px;
		    padding: 5px 15px 5px 10px;
		    width: 130px;
		    border-top-left-radius: 10px 50px;
		    border-bottom-left-radius: 10px 50px;
		    border-top-right-radius: 10px 50px;
		    border-bottom-right-radius: 10px 50px;
		    -webkit-transition: all 0.5s ease;
		    -moz-transition: all 0.5s ease;
			-ms-transition: all 0.5s ease;
			-o-transition: all 0.5s ease;
		    transition: all 0.5s ease;
		    color: #fff;
		    background: #48C9FF;
		    background: -webkit-linear-gradient(top, #48C9FF 0%, #2EA8E5 100%);
		    background: -moz-linear-gradient(top, #48C9FF 0%, #2EA8E5 100%);
		    background: -ms-linear-gradient(top, #48C9FF 0%, #2EA8E5 100%);
		    background: -o-linear-gradient(top, #48C9FF 0%, #2EA8E5 100%);
		    background: linear-gradient(to bottom, #48C9FF 0%, #2EA8E5 100%);
		    text-shadow: #29a3cc 0 1px 3px;
		}
		.preview_wallpaper_info a:hover {
			-moz-border-radius-topleft: 30px 50px;
		    -moz-border-radius-topright: 30px 50px;
		    -moz-border-radius-bottomright: 30px 50px;
		    -moz-border-radius-bottomleft: 30px 50px;
		    border-top-left-radius: 30px 50px;
		    border-bottom-left-radius: 30px 50px;
		    border-top-right-radius: 30px 50px;
		    border-bottom-right-radius: 30px 50px;
		}
	</style>
	</head>
	<?php
	if ($width > 570)
		$page_width = $width;
	else
		$page_width = 570;
	?>
	<body><div style="width:<?php echo $page_width;?>px;margin:auto;">
		<div class="preview_wallpaper_header">
			<div class="preview_wallpaper_left">
				<div class="preview_wallpaper_name">
					<?php echo '<a href="'.$wallpaper['url'].'">'.$wallpaper['name'].'</a>'; ?>
				</div>
				<div class="preview_wallpaper_info">
					<a href="<?php echo $wallpaper['download_url'];?>"><?php echo DOWNLOAD;?></a>
					<?php echo DOWNLOAD_INFO;?>
				</div>
			</div>
			<?php if ($width <= '1200') {
				echo '<br style="clear:both" /><div class="preview_wallpaper_right_short">';
			}
			else {
				echo '<div class="preview_wallpaper_right">';
			}
			?>
				<?php advert('advert_8'); ?>
			</div>
		</div>
		<?php $wallpaper['preview'] = $wallpaper['image']; ?>
		<img src="<?php echo $wallpaper['preview'];?>"/>
	</body></div>
</html>
