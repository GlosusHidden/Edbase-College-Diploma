<?php
	if (isset($_POST['aid'])){
		$aid=$_POST['aid'];
		mysql_query("UPDATE users SET type='2' WHERE id='$aid'");
	}
	if (isset($_POST['bid'])){
		$bid=$_POST['bid'];
		mysql_query("UPDATE users SET type='1' WHERE id='$bid'");
	}
	if (isset($_POST['userdel'])){
		$cid=$_POST['cid'];
		if ($cid!='1'){
			mysql_query("DELETE FROM users WHERE id='$cid'");
		}
	}
	if (isset($_POST['addsubject'])){
		$text=$_POST['text'];
		mysql_query("INSERT INTO subject (name) VALUES ('$text')");
	}
	if (isset($_POST['chansubject'])){
		$text=$_POST['text'];
		$did=$_POST['did'];
		mysql_query("UPDATE subject SET name='$text' WHERE id='$did'");
	}
	if (isset($_POST['delsubject'])){
		$did=$_POST['did'];
		mysql_query("DELETE FROM subject WHERE id='$did'");
	}
	if (isset($_POST['addtopic'])){
		$title=$_POST['title'];
		$text=$_POST['text'];
		mysql_query("INSERT INTO forumtopics (title, info) VALUES ('$title','$text')");
	}
	if (isset($_POST['chantopic'])){
		$title=$_POST['title'];
		$text=$_POST['text'];
		$eid=$_POST['eid'];
		mysql_query("UPDATE forumtopics SET title='$title', info='$text' WHERE id='$eid'");
	}
	if (isset($_POST['deltopic'])){
		$eid=$_POST['eid'];
		mysql_query("DELETE FROM forumtopics WHERE id='$eid'");
	}
	if (isset($_POST['delart'])){
		$fid=$_POST['fid'];
		mysql_query("DELETE FROM articles WHERE id='$fid'");
		$result = mysql_query("SELECT * FROM documents WHERE article =".$fid);
		$myrow = mysql_fetch_array($result);
		do { 
			$filename = 'pdf/'.$myrow['adress'].'.pdf';
			unlink($filename);  
		}while($myrow = mysql_fetch_array($result)); 
		mysql_free_result($result);	
		mysql_query("DELETE FROM documents WHERE article='$fid'");
	}
	if (isset($_POST['returnart'])){
		$fid=$_POST['fid'];
		mysql_query("UPDATE articles SET visible='1' WHERE id='$fid'");
	}
	if (isset($_POST['delarticles'])){
		$res = mysql_query("SELECT * FROM articles WHERE visible = '0'");
		$row = mysql_fetch_array($res);
		do { 
			$fid = $row['id'];
			mysql_query("DELETE FROM articles WHERE id='$fid'");
			$result = mysql_query("SELECT * FROM documents WHERE article =".$fid);
			$myrow = mysql_fetch_array($result);
			do { 
				$filename = 'pdf/'.$myrow['adress'].'.pdf';
				unlink($filename);  
			}while($myrow = mysql_fetch_array($result)); 
			mysql_free_result($result);	
			mysql_query("DELETE FROM documents WHERE article='$fid'");
		}while($row = mysql_fetch_array($res)); 
		mysql_free_result($res);	
		mysql_query("DELETE FROM articles WHERE visible='0'");
	}
	if (isset($_POST['returnarticles'])){
		mysql_query("UPDATE articles SET visible='1' WHERE visible='0'");
	}
?>