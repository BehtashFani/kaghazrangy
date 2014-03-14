<?php 
$total_wallpapers = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers"),0);
$total_users = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_users"),0);
$total_users_online = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_usersonline"),0);
$total_news = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_news"),0);
$total_comments = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_comments"),0);
$total_cats = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_cats"),0);
?> 
<ul class="stats_ul"> 
<li><strong><?php echo $total_users_online;?></strong> <?php echo STATS_USERS_ONLINE;?></li>
<li><strong><?php echo $total_wallpapers;?></strong> <?php echo STATS_WALLPAPERS;?></li> 
<li><strong><?php echo $total_users;?></strong> <?php echo STATS_MEMBERS;?></li> 
<li><strong><?php echo $total_news;?></strong> <?php echo STATS_NEWS;?></li> 
<li><strong><?php echo $total_comments;?></strong> <?php echo STATS_COMMENTS;?></li> 
<li><strong><?php echo $total_cats;?></strong> <?php echo STATS_CATEGORIES;?></li> 
</ul>