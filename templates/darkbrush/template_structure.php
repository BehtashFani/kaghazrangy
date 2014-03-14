<?php
// Advanced page options can be modified below.
// Most templates will not need to modify anything below this line
if (isset($_GET['task'])) {
	if ($_GET['task'] == 'view') {
		include '.'.$setting['template_url'].'/'.$template['wallpaper'];
	}
	else if ($_GET['task'] == 'category') {
		include '.'.$setting['template_url'].'/'.$template['category'];
	}
	else if ($_GET['task'] == 'profile') {
		include '.'.$setting['template_url'].'/'.$template['profile'];
	}
	else if ($_GET['task'] == 'news') {
		include '.'.$setting['template_url'].'/'.$template['news'];
	}
	else {
		include '.'.$setting['template_url'].'/'.$template['misc'];
	}
}
else {
	include '.'.$setting['template_url'].'/'.$template['homepage'];
}
?>