<div id='article' style="padding: 0px; margin: 0px;">
<div id="regpage">
	<h3>Регистрация</h3>
	<form action="" method="POST" id="regform">
		<table id="regtable">
			<tr>
				<td>Введите логин</td><td><input class="regin" type="text" name="login" maxlength="50" required></td>
			</tr>
			<tr>
				<td>Введите пароль</td><td><input class="regin" type="password" name="pass1" value="" required></td>
			</tr>
			<tr>
				<td>Повторите пароль</td><td><input class="regin" type="password" name="pass2" value="" required></td>
			</tr>
		</table>
		<input type="checkbox" id="rules" name="rules" required> 
		<span>Я прочитал и согласен с 
			<a href="/index.php?view=rules" id="ruleslink" target="_blank">Правилами пользования сайтом</a>
		</span><br>
		<input class="regbtn" type="submit" name="regsubmit" id="submit" value="Зарегистрироваться">
		<span id="regerror" style="color='red'"><?include($_SERVER['DOCUMENT_ROOT'].'/fns/regfns.php');?></span><br>
	</form>
</div>
</div>