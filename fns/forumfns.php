<?
	if ($_SESSION['type']=='0') {
		if (isset($_POST['commentdel'])){
			$delid = $_POST['delid'];
			mysql_query("delete FROM forumcomments where id='$delid'");
		}
	}
	if (isset($_SESSION['type'])) {
		if (isset($_POST['commentadd'])){
			$user=$_SESSION['login'];
			$text=addslashes(htmlspecialchars($_POST['commenttext']));
			$time = date("d M Y, H:i:s", time()-60*60);
			mysql_query("INSERT INTO forumcomments(ftid, user, date, text) VALUES ('$id', '$user', '$time', '$text')");
		}
	}
?>