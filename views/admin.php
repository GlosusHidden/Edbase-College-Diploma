<?if ($_SESSION['type']=='0'){
	include($_SERVER['DOCUMENT_ROOT'].'/fns/adminfns.php');
	$edit=$_GET['edit'];
	switch ($edit) {
    case users:
        $res=mysql_query("select * FROM users ORDER BY type, id");
		$row = mysql_fetch_array($res);
		$count=mysql_num_rows($res);
		if ($count>'0'){
			?><table id="adminusertable">
					<tr>
						<th>ID</th><th>Login</th><th>IP</th><th>Author</th><th></th>
					</tr><?
			do { ?>
					<tr>
						<td><a title="<?=$row['rdate']?>"><?=$row['id']?></a></td>
						<td><a title="<?=$row['fname'].' '.$row['sname'];?>"><?=$row['login']?></a></td>
						<td><a title="<?=$row['mail']?>"><?=$row['ip']?></a></td>
						<td><?
						switch ($row['type']) {
							case 0:
								echo "<input type='checkbox' checked disabled>";
								break;
							case 1:
								?>
								<form action="" name="usertype<?=$row['id']?>" id="usertype<?=$row['id']?>" method="post">
									<input type="hidden" name="aid" value="<?=$row['id']?>">
									<input type='checkbox' onchange="document.getElementById('usertype<?=$row['id']?>').submit()" checked>
								</form>
								<?
								break;
							case 2:
								?>
								<form action="" name="usertype<?=$row['id']?>" id="usertype<?=$row['id']?>" method="post">
									<input type="hidden" name="bid" value="<?=$row['id']?>">
									<input type='checkbox' onchange="document.getElementById('usertype<?=$row['id']?>').submit()">
								</form>
								<?
								break;
						}
						?></td>
						<td><?
						switch ($row['type']) {
							case 0:
								break;
							default:
								?>
								<form action="" name="userdel" method="post">
									<input type="hidden" name="cid" value="<?=$row['id']?>">
									<button type="submit" name="userdel" style="background: none; border: none; padding: 0px; outline: none; cursor: pointer;">
										<img src="img/icons/delete.png" onmouseover="this.src='img/icons/delete2.png'" onmouseout="this.src='img/icons/delete.png'" style='width: 16px; height: 16px; cursor: pointer;'>
									</button>
								</form>
								<?
								break;
						}
						?></td>
					</tr>	
			<?
			}while($row=mysql_fetch_array($res)); 
			?></table><?
		}
		else echo "<h4 style='padding-left: 10px;'>Данный раздел пока не заполнен.</h4>";
		mysql_free_result($res);
        break;
    case subjects:
		$res=mysql_query("SELECT * FROM subject ORDER BY id DESC");
		$row= mysql_fetch_array($res);
		?>
			<h3>Добавить</h3>
			<form action="" method="POST" name="addsubject">
				<input type="text" name="text" size="20" maxlength="512" class="userupdate">
				<button type="submit" name="addsubject" title="Add" class="admbigbtn">
						<img src="img/icons/subadd.png" onmouseover="this.src='img/icons/subadd2.png'" onmouseout="this.src='img/icons/subadd.png'" class="admbigicons">
				</button>
			</form>
		<?
		$count=mysql_num_rows($res);
		if ($count>'0'){
			?>
				<h3>Редактировать</h3>
			<?
			do{	
			?>
				<form action="" method="POST" name="editsubject">
					<input type="text" name="text" size="20" maxlength="512" value='<?=$row['name']?>' class="userupdate">
					<input type="hidden" name="did" value="<?=$row['id']?>">
					<button type="submit" name="chansubject" title="Edit" class="admbigbtn">
						<img src="img/icons/subedit.png" onmouseover="this.src='img/icons/subedit2.png'" onmouseout="this.src='img/icons/subedit.png'" class="admbigicons">
					</button>
					<button type="submit" name="delsubject" title="Delete" class="admbigbtn">
							<img src="img/icons/subdel.png" onmouseover="this.src='img/icons/subdel2.png'" onmouseout="this.src='img/icons/subdel.png'" class="admbigicons">
					</button>
				</form>
			<?
			}
			while($row=mysql_fetch_array($res)); 
		}
			mysql_free_result($res);
        break;
    case articles:
        $res=mysql_query("SELECT * FROM articles WHERE visible='0' ORDER BY id DESC");
		$row= mysql_fetch_array($res);
		$count=mysql_num_rows($res);
		if ($count>'0'){
			?><h4>Все удаленные статьи:</h4><?
			do{	
				?>		
				<form action="" name="chendel" method="post">
					<?=$row['title'];?>
					<input type="hidden" name="fid" value="<?=$row['id']?>">
					<button type="submit" name="delart" class="admsmlbtn" title="Delete">
						<img src="img/icons/delete.png" onmouseover="this.src='img/icons/delete2.png'" onmouseout="this.src='img/icons/delete.png'" class="admsmlicons">
					</button>
					<a href="/index.php?view=editpdf&id=<?=$row['id']?>" class="controlbtns" title="Pdf">
						<img src="img/icons/pdf.png" onmouseover="this.src='img/icons/pdf2.png'" onmouseout="this.src='img/icons/pdf.png'" class="admsmlicons">
					</a>
					<a href="/index.php?view=editarticle&id=<?=$row['id']?>" class="controlbtns" title="Edit">
						<img src="img/icons/edit.png" onmouseover="this.src='img/icons/edit2.png'" onmouseout="this.src='img/icons/edit.png'" class="admsmlicons">
					</a>
					<button type="submit" name="returnart" class="admsmlbtn" title="Restore">
						<img src="img/icons/return.png" onmouseover="this.src='img/icons/return2.png'" onmouseout="this.src='img/icons/return.png'" class="admsmlicons">
					</button>
					<p>
				</form>
				<?
			}
			while($row=mysql_fetch_array($res)); 
			?>
				<form action="" name="chendel" method="post">
					<input type="submit" name="returnarticles" value="Восстановаить все" class="admbtn"> <input type="submit" name="delarticles" value="Удалить все" class="admbtn">
				</form>
			<?
		}
		else{
			echo "<h4>Корзина пуста.</h4>";
		}
		mysql_free_result($res);
        break;
	case forum:
        $res=mysql_query("SELECT * FROM forumtopics ORDER BY id DESC");
		$row= mysql_fetch_array($res);
		?>
			<h3>Добавить</h3>
			<form action="" method="POST" name="addtopic">
				<input type="text" name="title" size="20" maxlength="512" class="userupdate">
				<textarea name="text" class="fttext"></textarea>
				<input type="submit" name="addtopic" value="Добавить" class="admbtn">
			</form>
		<?
		$count=mysql_num_rows($res);
		if ($count>'0'){
			?>
				<h3>Редактировать</h3>
			<?
			do{	
			?>
				<form action="" method="POST" name="edittopic">
					<input type="text" name="title" maxlength="512" class="userupdate" value="<?=$row['title']?>">
					<textarea name="text" class="fttext"><?=$row['info']?></textarea>
					<input type="hidden" name="eid" value="<?=$row['id']?>">
					<input type="submit" name="chantopic" value="Изменить" class="admbtn"> <input type="submit" name="deltopic" value="Удалить" class="admbtn">
				</form>
			<?
			}
			while($row=mysql_fetch_array($res));
		}
			mysql_free_result($res);
        break;
	case images:
		?>
			<h3>Изображения</h3>
			<form action="" method="POST">
				Переместить неиспользуемые изображения в корзину:
				<input type="submit" name="imgtobasket" value="Переместить" class="admbtn"><br>
				Очистить корзину:
				<input type="submit" name="freebasket" value="Очистить" class="admbtn">
			</form>
		<?	
		include($_SERVER['DOCUMENT_ROOT'].'/fns/removeextra.php');
        break;		
}
}	
?>