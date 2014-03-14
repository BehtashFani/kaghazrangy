<?php
// The main include for the misc pages. Will include the required page.

if ($_GET["task"] == 'login') 
	include 'login.php';
	
else if ($_GET["task"] == 'register') 
	include 'register.php';
	
else if ($_GET["task"] == 'view_message') 
	include 'view_message.php';

else if ($_GET["task"] == 'send_message') 
	include 'send_message.php';

else if ($_GET["task"] == 'messages') 
	include 'messages.php';

else if ($_GET["task"] == 'search') 
	include 'search.php';
	
else if ($_GET["task"] == 'edit_profile') 
	include 'edit_profile.php';

else if ($_GET["task"] == 'view_page') 
	include 'view_page.php';

else if ($_GET["task"] == 'member_list') 
	include 'member_list.php';

else if ($_GET["task"] == 'lost_password') 
	include 'lost_password.php';

else if ($_GET["task"] == 'validate') 
	include 'validate.php';

else if ($_GET["task"] == 'links') 
	include 'links.php';

else if ($_GET["task"] == 'sendtofriend') 
	include 'sendtofriend.php';

else if ($_GET["task"] == 'edit_avatar') 
	include 'avatar_upload.php';
	
else if ($_GET["task"] == 'tag') 
	include 'tag.php';
	
else if ($_GET["task"] == 'facebook_register') 
	include 'facebook_register.php';
	
else if ($_GET["task"] == 'submit') 
	include 'submit_wallpaper.php';
	
else
	include 'page_not_found.php';

?>