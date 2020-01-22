<?php
	if (isset($_POST['passsubmit'])){
		$pass0 = addslashes(htmlspecialchars($_POST['pass0']));
		$pass1 = addslashes(htmlspecialchars($_POST['pass1']));
		$pass2 = addslashes(htmlspecialchars($_POST['pass2']));
		$fid=$myrow['id'];
		if (($myrow['pass']==$pass0) and ($pass1==$pass2) and strlen($pass1)>'7' and strlen($pass1)<'17' and preg_match("/^[0-9a-zA-Zа\ \']+$/", $pass1)){
			mysql_query("UPDATE users SET pass='$pass1' WHERE id='$fid'");
			echo "<script>alert(\"Password changed!\");</script>";
		}
		else{
			echo "<script>alert(\"An error occurred during password change!\");</script>";
		}
	}
	if (isset($_POST['additionalsubmit'])){
		$fname = addslashes(htmlspecialchars($_POST['fname']));
		$sname = addslashes(htmlspecialchars($_POST['sname']));
		$mail = addslashes(htmlspecialchars($_POST['mail']));
		$fid=$myrow['id'];
		mysql_query("UPDATE users SET fname='$fname', sname='$sname', mail='$mail' WHERE id='$fid'");
		echo "<script>window.location.href = 'index.php?view=user';</script>";
	}
?>