<?php 
header("Content-Type: text/xml");

include('config.php');
include('includes/core.php');
include 'language/'.$setting['language'].'.php';

echo '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">

<channel>
  <title>'.$setting['site_name'].'</title>
  <link>'.$setting['site_url'].'</link>
  <description>'.NEWS_MODULE.'</description>';

$sql = mysql_query("SELECT * FROM wss_news ORDER BY id DESC LIMIT 20");
while($row = mysql_fetch_array($sql)) {

    $name = str_replace('&', "", $row['title']);
    $url = NewsUrl($row['id'], $row['seo_url']);
    $imgurl = $setting['site_url'].'/uploads/news_icons/'.$row['image'];

echo '
  <item>
    <title>'.$name.'</title>
    <link>'.$url.'</link>
    <description><![CDATA[ <a href="'.$url.'"><img align="left" vspace="4" hspace="6" src='.str_replace(' ','%20',$imgurl).' title="'.$name.'" alt="'.$name.'" width="64" height="64" /></a> '.strip_tags($row['content']).']]></description>
    <pubDate>'.date('D, d M Y H:i:s O', $row['date']).'</pubDate>
  </item>';}
  echo '
</channel>

</rss>';

?> s>';

?> 