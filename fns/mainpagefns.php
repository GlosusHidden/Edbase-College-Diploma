<?
if ($_SESSION['type']=='0' or $_SESSION['type']=='1') {
	if (isset($_POST['artdel'])){
		$fid=$_POST['fid'];
		mysql_query("UPDATE articles SET visible='0' WHERE id='$fid'");
	}
}
function article($myrow, $sessiontype){
	?>
	<div id="article">
		<div class="aheader"><a href="/index.php?view=article&id=<?=$myrow['id']?>"><?=$myrow['title']?></a></div>
		<input type="hidden" name="artid" class = "artid" value="<?=$myrow['id']?>">
		<div class="ainfo">
		<?
			$subres = mysql_query("select * FROM subject WHERE id =".$myrow['subject']);
			$subrow = mysql_fetch_array($subres);
			$autres = mysql_query("select * FROM users WHERE id =".$myrow['author']);
			$autrow = mysql_fetch_array($autres);
		?>
			<?
				if (!empty($autrow)) echo $autrow['login'];
				else echo "Unknown";
			?>
			| <?=$myrow['time']?> | <?=$subrow['name'];
			if ($sessiontype == '0' or $sessiontype == '1') {?>
				<form action="" name="artdel" method="post" class="controlbtns">
					<input type="hidden" name="fid" value="<?=$myrow['id']?>">
					<button type="submit" name="artdel" title="Delete">
						<img src="img/icons/delete.png" onmouseover="this.src='img/icons/delete2.png'" onmouseout="this.src='img/icons/delete.png'">
					</button>
				</form>
				<a href="/index.php?view=editpdf&id=<?=$myrow['id']?>" class="controlbtns" title="Pdf">
					<img src="img/icons/pdf.png" onmouseover="this.src='img/icons/pdf2.png'" onmouseout="this.src='img/icons/pdf.png'">
				</a>
				<a href="/index.php?view=editarticle&id=<?=$myrow['id']?>" class="controlbtns" title="Edit">
					<img src="img/icons/edit.png" onmouseover="this.src='img/icons/edit2.png'" onmouseout="this.src='img/icons/edit.png'">
				</a>
			<?}?>
		</div>
		<?mysql_free_result($subres);?>				
		<div class="atext"><?=mb_substr(strip_tags(stripslashes($myrow['text'])), 0, 240, 'UTF-8') . '...'?></div>
		<div class="alink"><a href="/index.php?view=article&id=<?=$myrow['id']?>">Читать дальше <span>»<span></a></div>
	</div>
	<?
}
?>