<?php
if (isset($_POST['id']) && isset($_POST['report'])) {
$userid = intval($_COOKIE['wss_userid']);
include '../../../config.php';
include '../../core.php';
include('../../..'.$setting['template_url'].'/template_settings.php');
$the_report = mysql_secure($_POST['report']);
$id = intval($_POST['id']);
$type = intval($_POST['type']);
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_COOKIE["wss_username"])){

$cookie_id = intval($_COOKIE["wss_userid"]);
$code = preg_replace("/[^a-z,A-Z,0-9]/", "", $_COOKIE['wss_code']);

$user = mysql_query("SELECT * FROM wss_users WHERE id=".$cookie_id."");
$user2 = mysql_fetch_array($user);
if ($user2['password'] == $code) {

mysql_query("INSERT INTO wss_reported (id, user, report, link_id, ip, type) VALUES ('', '$cookie_id', '$the_report', '$id', '$ip', '$type')");

}
}
else {
mysql_query("INSERT INTO wss_reported (id, user, report, link_id, ip, type) VALUES ('', '0', '$the_report', '$id', '$ip', '$type')");
}}
?>