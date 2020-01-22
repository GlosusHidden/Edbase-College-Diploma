<?
	include($_SERVER['DOCUMENT_ROOT'].'/fns/bdconnect.php');
	include($_SERVER['DOCUMENT_ROOT'].'/fns/mainpagefns.php');
	$last = $_POST['last'];	
	$session = $_POST['session'];	
	$result = mysql_query("select * FROM articles WHERE visible='1' AND id < '$last' ORDER BY id DESC LIMIT 5");
	$myrow = mysql_fetch_array($result);
	$count=mysql_num_rows($result);
	if ($count>'0'){
		do { 				
			article($myrow, $session);				
		}while($myrow = mysql_fetch_array($result));
	}
	mysql_close($link);
?>