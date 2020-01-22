<div id='article' style="padding: 0px; margin: 0px;">
<div id="discussionpage">
<?	$id=$_GET['id'];
	include($_SERVER['DOCUMENT_ROOT'].'/fns/forumfns.php');
	$result=mysql_query("select * FROM forumtopics WHERE id='$id'");
	$myrow = mysql_fetch_array($result);
	$count=mysql_num_rows($result);
	if ($count='1'){
		do { ?>
				<h3><?=$myrow['title']?></h3>
				<div id="article">
					<div class="atext"><p><?=$myrow['info']?><p></div>
				</div>
				<div id="article">
					<div class="commentwindow">
						<form action="" name="myform" id="myform" method="post">
							<div id="">Добавить комментарий</div>
							<textarea name="commenttext" required style="font-size: 18px;"></textarea>
							<?if (isset($_SESSION['type'])) {?>
								<input name="commentadd" type="submit" value="Добавить комментарий" class="commentadd"/>
							<?}else{?>
								<input type="button" value="Добавить комментарий" class="commentadd" onclick="on()"/>
							<?}?>
							<div style="clear:both;"></div>
						</form>
					</div>
					<?
					$result2=mysql_query("select * FROM forumcomments WHERE ftid='$id' ORDER BY id DESC LIMIT 20");
					$myrow2 = mysql_fetch_array($result2);
					$count2=mysql_num_rows($result2);
					if ($count2>'0'){
						do { 
						?>
							<div class="commentwindow">
								<div class="commentuser"><?=$myrow2['user']?></div> <div class="commentdate">· <?=$myrow2['date']?> </div>
								<?if ($_SESSION['type']=='0') {?>
									<form action="" name="formdel" method="post" class="commentform">
										<input type="hidden" name="delid" value="<?=$myrow2['id']?>">
										<input name="commentdel" type="submit" value="Удалить" class="commentdel"/>
									</form>
								<?}?>
								<div class="commenttext"><?=$myrow2['text']?></div>
							</div>
						<?
						}while($myrow2=mysql_fetch_array($result2));
					}?><p>
				</div><?
				mysql_free_result($result);?>
			<?
		}while($myrow=mysql_fetch_array($result));
	}
	else{
		echo "<h4 style='padding-left: 10px;'>Данного раздела не существует.</h4>";
	}
	mysql_free_result($result);
?>
</div>
</div>