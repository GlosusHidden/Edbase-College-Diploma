<div id='article' style="padding: 0px; margin: 0px;">
<div id="forumpage">
	<h3>Форум:</h3>
	<?
	$result=mysql_query("select * FROM forumtopics ORDER BY id");
	$myrow = mysql_fetch_array($result);
	$count=mysql_num_rows($result);
	if ($count>'0'){
		do { 
		?>
			<div id="article">
				<div class="aheader"><a href="/index.php?view=discussion&id=<?=$myrow['id']?>"><?=$myrow['title']?></a></div>
				<div class="atext"><?=$myrow['info']?><p></div>
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