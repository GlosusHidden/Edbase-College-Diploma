<?
	$host="";
	$db="edustorage";
	$user="root";
	$password="";
	$link = @mysql_connect($host, $user, $password) or die("Не могу подключиться"); 
	mysql_select_db($db, $link) or die ('Не могу выбрать БД');		
	mysql_query ("SET NAMES 'utf8'");
?>