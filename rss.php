<?php 
header("Content-Type: text/xml");

include('config.php');
include('includes/core.php');

// Include language file
include 'language/'.$setting['language'].'.php';

if (isset($_GET['feed']) && $_GET['feed'] == 'popular') {
$get = 'hits DESC';
$desc = RSS_MOST_POPULAR;}
else {
$get = 'id DESC';
$desc = RSS_NEWEST;}

echo '<?phpxml version="1.0" encoding="UTF-8" ?>

<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/">

<channel>
  <title>'.$setting['site_name'].'</title>
  <link>'.$setting['site_url'].'</link>
  <description>'.$desc.'</description>';

$sql = mysql_query("SELECT * FROM wss_wallpapers WHERE published=1 ORDER BY $get LIMIT 20");
while($row = mysql_fetch_array($sql)) {

    $name = str_replace('&', "", $row['name']);
    $url = WallpaperUrl($row['id'], $row['seo_url'], $row['category']);
    $imgurl = WallpaperThumbnail($row, '150', '85');

echo '
  <item>
    <title>'.$name.'</title>
    <link>'.$url.'</link>
    <description><![CDATA[ <a href="'.$url.'"><img align="left" vspace="4" hspace="6" src='.str_replace(' ','%20',$imgurl).' title="'.$name.'" alt="'.$name.'" width="150" height="85" /></a> '.strip_tags($row['description']).']]></description>
    <pubDate>'.date('D, d M Y H:i:s O', $row['date_added']).'</pubDate>
  </item>';}
  echo '
</channel>

</rss>';

?> 