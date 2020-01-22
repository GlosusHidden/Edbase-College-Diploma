<?include($_SERVER['DOCUMENT_ROOT'].'/fns/loginfns.php');?>
<div id="loginbg">
	<div id="logindialog">
	<div class="rwtitle">Вход</div><img src="img/icons/close.png" onmouseover="this.src='img/icons/close2.png'" onmouseout="this.src='img/icons/close.png'" onclick="off()" class="rwexitbtn">
		<form action="" method="POST" id="loginwindow">
			<input class="rwin" type="text" name="login" maxlength="50" required placeholder="Логин"><br>
			<input class="rwin" type="password" name="pass" value="" required placeholder="Пароль"><br>
			<input class="rwbtn" type="submit" name="loginsubmit" id="submit" value="Войти">
		</form>
		<a href="/index.php?view=registration" class="rwregbtn">Регистрация</a>
	</div>
</div>