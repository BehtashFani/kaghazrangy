<?php 
$i = 1;
if($wallpaper['display'] != 'original') { 

$resolutions = resolutionsList();  // Resolutions are now in the root directory in resolutions.php

$z = 'list';
if ($setting['resolutions_display'] == 'dropdown') {
	echo '<select class="select" id="resolution" name="resolution">
	<option value="">'.SELECT_RESOLUTION.':</option>';
	foreach ($resolutions as $ckey => $category) {
		echo '<optgroup label="'.$ckey.'"> ';
		foreach ($resolutions[$ckey] as $rkey => $resolution) {
			$dimensions = explode('x', $rkey);
			if ($setting['show_all_resolutions'] == 1 || ($dimensions[0] <= $wallpaper['original_width'] && $dimensions[1] <= $wallpaper['original_height'])) {
				if ($dimensions[0] == $wallpaper['original_width'] && $dimensions[1] == $wallpaper['original_height']) 
					$original = '(Original)';
				else
					$original = '';
  				echo '<option value="'.$rkey.'">'.$resolution.' '.$original.'</option>';
  			}
  		}
  	}
	echo '</select>
	
	<script type="text/javascript">
		setScreenRes(\'dd\');
	</script>

	<input type="button" value="'.PREVIEW.'" onclick="getWallpaper('.$wallpaper['id'].", '".$row2['seo_url']."', '".$row2['display']."', 'preview', '$setting[seo_extension]')\" />".' 
	<input type="button" value="'.DOWNLOAD.'" onclick="getWallpaper('.$wallpaper['id'].", '".$row2['seo_url']."', '".$row2['display']."', 'download', '$wallpaper[file_extension]')\" />";
}
else {
	echo '<div class="resolutions_list_container">
	<div class="resolutions_list_header">'.SELECT_RESOLUTION.'</div>
	<div class="resolutions_row">';
	foreach ($resolutions as $ckey => $category) {
		echo '<div class="resolution_category"><div class="resolution_title">'.$ckey.'</div>';
		foreach ($resolutions[$ckey] as $rkey => $resolution) {
			$dimensions = explode('x', $rkey);
			if ($setting['show_all_resolutions'] == 1 || ($dimensions[0] <= $wallpaper['original_width'] && $dimensions[1] <= $wallpaper['original_height'])) {
				if ($dimensions[0] == $wallpaper['original_width'] && $dimensions[1] == $wallpaper['original_height']) 
					$original = '(Original)';
				else
					$original = '';
  				echo '<div class="resolution_item"><a id="resolution_link_'.$rkey.'" href="'.PreviewUrl($rkey).'" target="_blank" onclick="countDownload('.$id.');">'.$resolution.' '.$original.'</a></div>';
  			}
  		}
  		echo '</div>';
  		
  		if ($i == 6) {
  			echo '</div><div class="resolutions_row">';
  			$i = 1;
  		}
  	}
  	echo '</div></div>
  	
  	<script type="text/javascript">
		setScreenRes(\'list\');
	</script>';
}
?>
            
<?php } else { ?>
<div class="original_download_container">
	<a class="original_download_button" href="<?php echo PreviewUrl($wallpaper['original_width'].'x'.$wallpaper['original_height']);?>" target="_blank" onclick="countDownload(<?php echo $id.",'".$setting['site_url']."'";?>, 'wallpaper')">Download</a>
</div>
<?php } ?>