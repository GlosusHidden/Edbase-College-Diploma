<?
	$id=$_GET['id'];
	$result=mysql_query("select * FROM articles WHERE id='$id'");
	$myrow = mysql_fetch_array($result);
	$subres = mysql_query("select * FROM subject WHERE id =".$myrow['subject']);
	$subrow = mysql_fetch_array($subres);
	$autres = mysql_query("select * FROM users WHERE id =".$myrow['author']);
	$autrow = mysql_fetch_array($autres);
	$docres = mysql_query("select * FROM documents WHERE article = ".$id." ORDER BY ord");
	$docrow = mysql_fetch_array($docres);
?>	
	<div id="articlepage">
		<h3><?=$myrow['title']?></h3>
		<hr>
		<div class="artinfo">
		<?
			if (!empty($autrow)) echo $autrow['login'];
			else echo "Unknown";
		?>
		| <?=$myrow['time']?> | <?=$subrow['name']?></div>
		<hr><p>
		<div class="arttext"><?=stripslashes($myrow['text'])?></div>
		<?
			$count=mysql_num_rows($docres);
			if ($count > '0'){
				echo "<h3>Дополнительные файлы: </h3>";
				do {
		?>
			<a href="pdf/<?=$docrow['adress']?>.pdf" target="_blank" title="Open">
				<img src = "img/icons/newtab.png" onmouseover = "this.src='img/icons/newtab2.png'" onmouseout = "this.src='img/icons/newtab.png'" class = "newtabimg">
			</a>
			<details class = "detpdf" onclick="loadpdf('<?=$docrow['adress']?>', '<?=$docrow['id']?>')">
				<summary class = "sumpdf"><?=$docrow['name']?></summary>
				<div id="pdf<?=$docrow['id']?>"></div>
			</details>
		<?
				}while($docrow=mysql_fetch_array($docres));
			}
		?>
	</div>
<?
	mysql_free_result($docres);	
	mysql_free_result($autres);	
	mysql_free_result($subres);	
	mysql_free_result($result);
?>