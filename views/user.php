<?
if (isset($_SESSION['login'])){
	if (isset($_POST['exitbtn'])){
		session_destroy();
		echo "<script>window.location.href = 'index.php?view=main';</script>";
	}
	$login=$_SESSION['login'];
	$edit = empty($_GET['edit']) ? 'main' : $_GET['edit'];
	$result=mysql_query("select * FROM users WHERE login='$login'");
	$myrow = mysql_fetch_array($result);
	include($_SERVER['DOCUMENT_ROOT'].'/fns/userfns.php');
	?>
	<div id="userpage">
		<div id="upmenu">
			<ul>
				<a href="/index.php?view=user&edit=main"><li>Личная информация</li></a>
				<?if ($_SESSION['type']=='0'){?>
				<a href="/index.php?view=user&edit=users"><li>Пользователи сайта</li></a>
				<a href="/index.php?view=user&edit=subjects"><li>Список предметов</li></a>
				<a href="/index.php?view=user&edit=articles"><li>Удаленные статьи</li></a>
				<a href="/index.php?view=user&edit=forum"><li>Темы форума</li></a>
				<a href="/index.php?view=user&edit=images"><li>Изображения</li></a>
				<?}?>
				<form method="POST" id="exitform"><li><input type="submit" name="exitbtn" value="Выход" id="exitbtn"></li></form>
			</ul>
		</div>
		<div id="upcontent">
			<?if ($edit=='main'){
				echo "<b>".$_SESSION['login']."</b>";
				switch ($_SESSION['type']) {
					case 0:
						echo " (Администратор)";
						break;
					case 1:
						echo " (Автор)";
						break;
					case 2:
						echo " (Пользователь)";
						break;
				}
				?>
				<span class="userid">#<?=$myrow['id']?></span>
				<hr>
				Изменение пароля:<p>
				<form action="" method="POST">
					<input class="userupdate" type="password" name="pass0" value="" required placeholder="Старый пароль"><br>
					<input class="userupdate" type="password" name="pass1" value="" required placeholder="Новый пароль"><br>
					<input class="userupdate" type="password" name="pass2" value="" required placeholder="Повторите пароль"><br>
					<input class="rwbtn" type="submit" name="passsubmit" id="submit" value="Изменить пароль">
				</form>
				<hr>
				Дополнительная информация: <p>
				<form action="" method="POST">
					<input class="userupdate" type="text" name="fname" maxlength="50" placeholder="Имя" value="<?=$myrow['fname']?>"><br>
					<input class="userupdate" type="text" name="sname" maxlength="50" placeholder="Фамилия" value="<?=$myrow['sname']?>"><br>
					<input class="userupdate" type="text" name="mail" maxlength="50" placeholder="Почта" value="<?=$myrow['mail']?>"><br>
					<input class="rwbtn" type="submit" name="additionalsubmit" id="submit" value="Добавить">
				</form>
				<?
				
			}
			else{
				include($_SERVER['DOCUMENT_ROOT'].'/views/admin.php');
			}
			?>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?
	mysql_free_result($result);
}
?>