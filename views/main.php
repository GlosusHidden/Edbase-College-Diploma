<?
	include($_SERVER['DOCUMENT_ROOT'].'/fns/mainpagefns.php');
?>
<div id="toolbar">
	<a onclick="artsubject()">Категории</a> | 
	<?if (empty($_SESSION['login'])){?>
	<a onclick="on()">
	<?
	}
	else{
		if (($_SESSION['type']=='0') or ($_SESSION['type']=='1')){
			?><a href = "/index.php?view=editarticle"><?
		}
		else{
			?><a onclick = "javascript: window.alert('Access denied! Contact your administrator to obtain permission.');"><?
		}	
	}?>
	Добавить статью</a>
	 | Поиск
	<form class="form-search" method="get" action="">
	<input type="text" name="search" placeholder="поиск" value="" onclick="artsubjectoff()"/></form>
	<div id="artsubjects">
		<?
			$result1=mysql_query("select * FROM subject ORDER BY id DESC");
			$myrow1 = mysql_fetch_array($result1);
			do { 
			?>
				<a href="/index.php?view=main&subject=<?=$myrow1['id']?>"><?=$myrow1['name']?></a>
			<?
				}while($myrow1=mysql_fetch_array($result1)); 
			mysql_free_result($result1);
		?>
	</div>
</div>
<?
	$subject=$_GET['subject'];
	$search= addslashes(htmlspecialchars($_GET['search']));
	if (empty($search)){
		if (empty($subject)){
			$result=mysql_query("select * FROM articles WHERE visible='1' ORDER BY id DESC LIMIT 5");
			$myrow = mysql_fetch_array($result);
			$count=mysql_num_rows($result);
			if ($count>'0'){
				do { 				
					article($myrow, $_SESSION['type']);
					$last = $myrow['id'];					
				}while($myrow = mysql_fetch_array($result));
				echo "<div id = 'scrollifon' style = 'visibility: hidden;'>".$_SESSION['type']."</div>";
			} 
			else{
				echo "<h4><div id='article' style=\"padding: 5px 18px; margin: 0px;\">Данный раздел пока не заполнен.<div></h4>";
			}
			mysql_free_result($result);
		}
		else{	
			$result=mysql_query("select * FROM articles WHERE subject='$subject' AND visible='1'  ORDER BY id DESC  LIMIT 40");
			$myrow = mysql_fetch_array($result);
			$count=mysql_num_rows($result);
			if ($count>'0'){
				do { 
					article($myrow, $_SESSION['type']);
				}while($myrow = mysql_fetch_array($result));
			} 
			else{
				echo "<h4><div id='article' style=\"padding: 5px 18px; margin: 0px;\">Данный раздел пока не заполнен.</div></h4>";
			}
			mysql_free_result($result);
		}
	}
	else{
		if (mb_strlen($search)<"4") {
			echo "<h4><div id='article' style=\"padding: 5px 18px; margin: 0px;\">Короткий запрос.</div></h4>";
		}
		else{
			$result=mysql_query("select * FROM articles WHERE (text RLIKE '$search' OR title RLIKE '$search' OR author='$search')  AND visible='1' ORDER BY id DESC LIMIT 20");
			$myrow = mysql_fetch_array($result);
			$count=mysql_num_rows($result);
			if ($count>'0'){
				echo "<h4><div id='article' style=\"padding: 5px 18px; margin: 0px;\">Результаты поиска:</div></h4>";
				do { 
					article($myrow, $_SESSION['type']);
				}while($myrow = mysql_fetch_array($result));
			} 
			else{
				echo "<h4><div id='article' style=\"padding: 5px 18px; margin: 0px;\">Ни чего не найдено.</div></h4>";
			}
			mysql_free_result($result);	
		}
	}
?>