<?php
	if (isset($_POST['loginsubmit'])){
		$login = addslashes(htmlspecialchars($_POST['login']));
		$pass = addslashes(htmlspecialchars($_POST['pass']));
		$result=mysql_query("select * FROM users where login='$login'");
		$account=mysql_num_rows($result);
		$myrow = mysql_fetch_array($result);
		if (empty($account)){
				echo "<script>alert(\"Such a user is not logged in!\");</script>";
			}
			else{
				if($myrow['pass'] == $pass){
						$_SESSION['login'] = $login;
						$_SESSION['type'] = $myrow['type'];
						$_SESSION['userid'] = $myrow['id'];
				}
				else{
					echo "<script>alert(\"Bad password!\");</script>";
				}
			}
		mysql_free_result($result);
	}
?>