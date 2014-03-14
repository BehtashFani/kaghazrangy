<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $setting['site_url'].$setting['template_url'];?>/style.css" />
<?php include 'includes/header_data.inc.php';?>
</head>

<body>
<?php
if ($setting['site_offline'] == 1) {
		echo '<div style="background-color:#73000b;text-align:center;color:#fff;font-family:Arial;padding:10px;">Matinence mode active - site not accessible to non-admins</div>';
	}
?>

<!-- Report popup and overlay !-->
<div id="ava-popup">
	<div id="ava-popup-header">
		<div id="ava-popup-title"></div>
		<div id="popup-close-button" onclick="HidePopup('ava-popup');"></div>
	</div>
	<div id="ava-popup-content"></div>
</div>
<div id="overlay" onclick="HidePopup('ava-popup')"></div>

<div class="header">
	<div class="header_logo">
		<a href="<?php echo $setting['site_url'];?>"><img src="<?php echo $setting['site_url'].$setting['template_url'];?>/images/logo.png" alt="<?php echo $setting['site_name'];?>" /></a>
	</div>
	<div class="header_right">
		<?php advert('advert_1'); ?>
	</div>
	<br style="clear:both;" />
</div>

<div class="menu">
		<div class="menu_left">
			<div class="menu_item">
				<?php include 'includes/modules/pages_horizontal.php'; ?>
			</div>
		</div>
		<div class="menu_right">
			<form action="<?php echo $setting['site_url']?>/index.php?task=search" method="get" onsubmit="<?php echo $search_function;?>">
  				<input name="task" type="hidden" value="search" />
  				<div class="search_contain"> 
  					<div class="search_contain_left">
  						<input name="q" type="text" size="20" id="search_textbox" value="<?php echo $search_val;?>" onclick="clickclear(this, '<?php echo SEARCH_DEFAULT;?>')" onblur="clickrecall(this,'<?php echo SEARCH_DEFAULT;?>')" class="search_box"/>  
  					</div>
  					<div class="search_contain_right">
  						<input type="image" style="margin-top:7px;" src="<?php echo $setting['site_url'].$setting['template_url'];?>/images/search_button.png" />
  					</div>
  				</div>
  			</form>
		</div>
	</div>

<div class="mc_bg">
<div class="main_container">