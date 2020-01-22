<?
if ($_SESSION['type']=='0'){
	if (isset($_POST['submittestcreation'])){
		$subject=$_POST['subject'];
		$title=$_POST['title'];
		mysql_query("INSERT INTO tests (subject, title) VALUES ('$subject','$title')");
	}
	if (isset($_POST['deltest'])){
		$id=$_POST['id'];
		mysql_query("DELETE FROM tests WHERE id='$id'");
		mysql_query("DELETE FROM questions WHERE testid='$id'");
		mysql_query("DELETE FROM results WHERE testid='$id'");
	}
}
?>
<div id='article' style="padding: 0px; margin: 0px;">
<div id="testspage">
	<h3>Тестирование: </h3>
	<?
	if ($_SESSION['type']=='0'){
	?>
	<div id="article">
	<form action="" name="testcreate" method="post">
		<p><div class="atext"><b>Добавить тест: </b>
		<select name="subject" class="testsublist">
		<?
		$result=mysql_query("select * FROM subject ORDER BY id DESC");
		$myrow = mysql_fetch_array($result);
		do { 
		?>
			<option><?=$myrow['name']?></option>
		<?
			}while($myrow=mysql_fetch_array($result)); 
		mysql_free_result($result);
		?>
		</select>
		<input class="testinp" type="text" name="title" required="">
		<input name="submittestcreation" type="submit" value="Добавить тест" class="commentadd" style="margin: 0px; font-size: 16px; float: none; padding: 4px 36px; margin-left: 4px;">
		<p></div>
	</form>
	</div>
	<?
	}
	$result=mysql_query("select * FROM tests ORDER BY id DESC");
	$myrow = mysql_fetch_array($result);
	$count=mysql_num_rows($result);
	if ($count>'0'){
		do { 
		?>
			<div id="article">
				<div class="aheader">
				<?if (empty($_SESSION['login'])){?>
					<a onclick="on()">
					<?
					}
					else{
						?> <a href="/index.php?view=testing&test=<?=$myrow['id']?>"> <?	
					}?>
				<?=$myrow['title'].' ('.$myrow['subject'].')'?> </a>			
				</div>
				<?if ($_SESSION['type']=='0') {?>
				<form action="" name="testedit" method="post" class="controlbtns" style="margin-top: 15px;">
					<input type="hidden" name="id" value="<?=$myrow['id']?>">
					<button type="submit" name="deltest" style="background: none; border: none; padding: 0px; outline: none; cursor: pointer; float: right; margin-left: 10px;" title = "Delete">
						<img src="img/icons/delete.png" onmouseover="this.src='img/icons/delete2.png'" onmouseout="this.src='img/icons/delete.png'" style="width: 16px; height: 16px; cursor: pointer;">
					</button>
					<a href="/index.php?view=testedit&test=<?=$myrow['id']?>" title = "Edit">
						<img src="img/icons/edit.png" onmouseover="this.src='img/icons/edit2.png'" onmouseout="this.src='img/icons/edit.png'" style="width: 16px; height: 16px; cursor: pointer; float: right; margin-left: 12px;">
					</a>
					<a href="/index.php?view=testresult&test=<?=$myrow['id']?>" title = "Results">
						<img src="img/icons/result.png" onmouseover="this.src='img/icons/result2.png'" onmouseout="this.src='img/icons/result.png'" style="width: 16px; height: 16px; cursor: pointer; float: right; margin-left: 12px;">
					</a>
				</form>
			<?}?>
				
			</div>
		<?
		}while($myrow=mysql_fetch_array($result));
	} 
	else{
		echo "<h4 style='padding-left: 10px;'>Данный раздел пока не заполнен.</h4>";
	}
	mysql_free_result($result);
	?>
</div>
</div>