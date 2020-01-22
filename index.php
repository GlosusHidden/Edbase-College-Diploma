<?php session_start();?>
<!DOCTYPE html>
<head>
    <title>Edbase</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta content='IE=edge' http-equiv='X-UA-Compatible'/>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<html lang="ru">
	<link rel="shortcut icon" href="img/icons/icon.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="jquery/jquery-2.1.4.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
<?include($_SERVER['DOCUMENT_ROOT'].'/fns/bdconnect.php');?>
	<div id="wrapper">
		<?include($_SERVER['DOCUMENT_ROOT'].'/views/login.php');?>
		<div id="header">
			<a href="#" title="Меню" onclick="showMainMenu()" id="navbaropen" class="topmenu">Меню</a>
			<?if (empty($_SESSION['login'])){?>
				<a id="navbaruser" onclick="on()" class="topmenu">Вход</a>
			<?}
			else {?>
				<a id="navbaruser" href="/index.php?view=user" class="topmenu"><?=$_SESSION['login'];?></a>
			<?};?>
			<div id="navdelim"></div>
			<ul id="navbar">	
				<li><a href="/index.php?view=main" title="Главная" class="topmenu">Главная</a></li>
				<li><a href="/index.php?view=tests" title="Тесты" class="topmenu">Тесты</a>        
				<li><a href="/index.php?view=forum" title="Форум" class="topmenu">Форум</a></li>
				<li><a href="/index.php?view=about" title="О нас" class="topmenu">О нас</a></li>
			</ul>
			<div style="clear:both;"></div>
		</div>
		<div id="content">
			<?
				$view = empty($_GET['view']) ? 'main' : $_GET['view'];
				@include($_SERVER['DOCUMENT_ROOT'].'/views/'.$view.'.php');
			?>
		</div>
		<div style="height: 50px;"></div>
		<div id="footer">
			Пчелкин Александр 2016 год.
		</div>
	</div>
	<?
	mysql_close($link);
?>
</body>
</html>
