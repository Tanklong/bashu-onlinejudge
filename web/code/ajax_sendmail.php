<?php
function UserExist($uid){
	if(preg_match('/\W/',$uid))
		return false;
	$res=mysql_query("select user_id from users where user_id='$uid'");
	if($res && mysql_num_rows($res))
		return true;
	return false;
}
session_start();
header('Content-Type: text/html; charset=utf-8');
if(!isset($_SESSION['user']))
	die('Not Logged in');
$from=$_SESSION['user'];

require('inc/database.php');

if(!isset($_POST['touser']) || strlen($touser=mysql_real_escape_string(trim($_POST['touser'])))==0)
	die('"To User" can\'t be empty.');
if(!UserExist($touser))
	die('No such user.');
if(!isset($_POST['title']) || strlen($title=mysql_real_escape_string(trim($_POST['title'])))==0)
	die('Title can\'t be empty.');
if(isset($_POST['detail']))
	$detail=mysql_real_escape_string($_POST['detail']);
else
	$detail='';
mysql_query("insert into mail (from_user,to_user,title,content,in_date) VALUES ('$from','$touser','$title','$detail',NOW())");

echo '__OK__';
?>