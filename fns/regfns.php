<?php
	if (isset($_POST['regsubmit'])){
		$login = addslashes(htmlspecialchars($_POST['login']));
		$pass1 = addslashes(htmlspecialchars($_POST['pass1']));
		$pass2 = addslashes(htmlspecialchars($_POST['pass2']));
		$rules = $_POST['rules'];
		$ip=getenv("REMOTE_ADDR");
		$date = date("d M Y, H:i:s", time()-60*60);
		 if (strlen($login)>'4' and strlen($login)<'17'  and preg_match("/^[0-9a-zA-Zà\ \']+$/", $login) and strlen($pass1)>'7' and strlen($pass1)<'17' and preg_match("/^[0-9a-zA-Zà\ \']+$/", $pass1)) {  
			if ($pass1==$pass2){
				if($rules=="on"){
					$result=mysql_query('select * FROM users');
					$num=mysql_num_rows($result);
					if (empty($num)){
						$type='0';
					}
					else{
						$type='2';
					}
					$result = mysql_query("select * FROM users where login='$login'");
					$account=mysql_num_rows($result);
					if (empty($account)){
						if (mysql_query("INSERT INTO users(login, pass, ip, rdate, type) VALUES ('$login', '$pass1', '$ip', '$date', '$type')")){
							echo "<script>alert(\"Account created!\");</script>";
							echo "<script> window.location.href = 'index.php?view=main'</script>";
						}else{
							echo "<script>alert(\"Something went wrong!\");</script>";
						}
					}
					else{
						echo "Username is already taken";
					}
					mysql_free_result($result);
				}
				else{
					echo "Rules are not accepted";
				}
			}
			else{
				 echo "Passwords do not match";
			}
		}
		 else{
			 echo "Bad login or password";
		 }
	}
?>