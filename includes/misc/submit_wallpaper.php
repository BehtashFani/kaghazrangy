<?php
defined( 'WSS_' ) or die( '' );
if (($user['login_status'] == 1) && ($setting['allow_submissions'] == 1)) {
	if ($_POST) {
		$strippedname = str_replace(" ", "-", $_POST['name']);
		if ($strippedname != '') {
			//Сheck that we have a file
			if ((!empty($_FILES["file"])) && ($_FILES['file']['error'] == 0)) {
				//Check if the file is an image using mime details and file extension
				$filename = basename($_FILES['file']['name']);
				$ext = substr($filename, strrpos($filename, '.') + 1);
				if (($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "PNG" || $ext == "JPG" || $ext == "JPEG" || $ext == "GIF")
				&& ($_FILES["file"]["type"] == "image/png" || $_FILES["file"]["type"] == "image/x-png" || $_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/pjpeg" || $_FILES["file"]["type"] == "image/gif")) {
					$max_file_size = ($setting['max_image_filesize'] * 1048576);
					if ($_FILES["file"]["size"] <= $max_file_size) {
						list($width, $height) = getimagesize($_FILES['file']['tmp_name']);
						if ($width >= $setting['min_upload_width'] && $height >= $setting['min_upload_height']) {

							$rand_name = rand();
							$name = substr($filename, 0,strrpos($filename,'.'));
							$name = str_replace(" ", "_", $name);
							$file_name = $name.'_'.$rand_name.'.'.$ext;
							$newname = 'files/submissions/'.$file_name;
							if ((move_uploaded_file($_FILES['file']['tmp_name'], $newname))) {
						
								$name = mysql_secure($_POST['name']);
								$description = mysql_secure($_POST['description']);
								$tags = mysql_secure($_POST['tags']);
								$category = intval($_POST['category']);
						
								mysql_query("INSERT INTO wss_submissions (name, description, tags, file, category, user) VALUES ('$name', '$description', '$tags', '$newname', $category, $user[id])");
							
								echo '<div id="error_message">'.SUBMIT_SUCCESS.'</div>';
							} else {
								echo '<div id="error_message">'.SUBMIT_E.'</div>';
							}
						} else {
							echo '<div id="error_message">'.SUBMIT_E_DIMENSIONS.'</div>';
						}
					} else {
						echo '<div id="error_message">'.SUBMIT_E_SIZE.'</div>';
					}
				} else {
					echo '<div id="error_message">'.SUBMIT_E_FILETYPE.'</div>';
				}
			} else {
				echo '<div id="error_message">'.SUBMIT_E_NOFILE.'</div>';
			}
		} else {
			echo '<div id="error_message">'.SUBMIT_E_NONAME.'</div>';
		}
	}
	include 'includes/forms/submit_wallpaper.php';
}
else {
	echo '<div id="error_message">'.SUBMIT_E_NOLOGIN.'</div>';
}

?>