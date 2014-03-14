<!-- Contents in this file will wrapped in <li> tags for the AJAX comments system. The in-built styles for the list are #comments ul and #comments ul li and are included at the top of the CSS file -->

<?php echo '
<div class="comment_avatar">
	<img src="'.$comment['avatar_url'].'" width="50" height="50" alt="avatar" />
</div>
<div class="comment_content">
	<div class="comment_username">
		<a href="'.$comment['user_url'].'">'.$comment['username'].'</a> - '.$comment['date'].' '.$comment['report_button'].' '.$comment['delete'].'
	</div>

	<div class="thecomment">
		'.$comment['content'].'
	</div>
</div>
<br style="clear:both" />';	
	?>