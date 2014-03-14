<?php
echo '
<div class="news_wrapper">
	<div class="news_header">

		<div class="news_title">

			<a href="'.$news['news_url'].'">'.$news['title'].'</a>

			<div class="news_author">
				'.POSTBY.': <a href="'.$news['user_url'].'" id="author">'.$news['author'].'</a>
			</div>
			'.$news['date'].'
			<a href="'.$news['news_url'].'" id="comments">'.$news['comments'].' '.NEWS_COMMENTS2.'</a>
		</div>
	</div>

	<div class="news_main">'.$news['main'].'</div>
</div>';
?>