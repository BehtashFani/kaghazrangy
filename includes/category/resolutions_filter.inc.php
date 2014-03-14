<?php

$resolutions = resolutionsList();

$selected = 'none';
if (isset($_COOKIE['wss_resfilter'])) {
	$selected = secure($_COOKIE['wss_resfilter']);
}

echo '<select class="select" id="resolution_filter" name="resolution_filter" onchange="setResFilter();">
	<option value="all">'.ALL_RESOLUTIONS.'</option>';
	foreach ($resolutions as $ckey => $category) {
		echo '<optgroup label="'.$ckey.'"> ';
		foreach ($resolutions[$ckey] as $rkey => $resolution) {
			$select = '';
			if ($selected == $rkey) {
				$select = ' selected="selected"';
			}
  				echo '<option value="'.$rkey.'"'.$select.'>'.$resolution.' '.$original.'</option>';
  		}
  	}
	echo '</select>';	
?>