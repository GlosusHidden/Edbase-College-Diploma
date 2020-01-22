<?
	$id = $_GET['id']; //Номер статьи (если он есть)
	if (!empty($id)){ 
		$res = mysql_query("select * FROM articles WHERE id='$id'");
		$row = mysql_fetch_array($res);
	} //Выборка данных из БД
	if (($_SESSION['type'] == '0') or ($_SESSION['type'] == '1')){?>
		<body onLoad = "iFrameEdit()">
		<div id = 'articleedit'>
		<div id = "createarticle">
			<form action = "" name = "myform" id = "myform" method = "post">
			<br>
			<details open id = "arteditdet">
			<summary id = "arteditsum" onclick = "rtfsize()">Создание статьи</summary>
			<br>
			Тема <input class = "crpnlin" type = "text" name = "title" required value = "<?if (!empty($id)) echo $row['title']?>"><br><br>
			Предмет
			<select name="subject">
				<?
					$result = mysql_query("select * FROM subject ORDER BY id DESC");
					$myrow = mysql_fetch_array($result);
					do { 
				?>
						<option value = <?=$myrow['id'];?> <?if ((!empty($id)) and ($myrow['id'] == $row['subject'])) echo "selected";?>><?=$myrow['name']?></option>
				<?
					}while ($myrow = mysql_fetch_array($result)); 
					mysql_free_result($result);
				?>
			</select><br><br>
			Текст статьи
			</details><br>
			<?include($_SERVER['DOCUMENT_ROOT'].'/views/editpanel.php');?>
			<input type="range" min="0" max="1000" step="1" oninput="resize(value, name)" onblur="this.style.display='none'" style="display: none" id="imgrange">
			<input type="hidden" value="<?=htmlspecialchars($row['text'])?>" id="hiddentext"/>
			<?
				if (empty($id)) echo "<input type='hidden' value='0' name='editadd'>";
				else echo "<input type='hidden' value='1' name='editadd'>";
			?>
			<input type="hidden" value="<?=$id?>" name="editnum"/>
			<textarea style="display:none;" name="myTextArea" id="myTextArea" cols="36" rows="8"></textarea>
			<iframe src="fns/richTextField.php" name="richTextField" id="richTextField"></iframe>
			<br><input name="addartbtn" type="button" value="Сохранить" onClick="javascript:submit_form();" class="regbtn"/>
			</form>
		</div>
		</div>
		<div id="uploadbg">
			<div id="uploadwindow">
				<div class="rwtitle">Загрузка изображения</div><img src="img/icons/close.png" onmouseover="this.src='img/icons/close2.png'" onmouseout="this.src='img/icons/close.png'" onclick="uploadoff()" class="rwexitbtn">
					<iframe src="fns/upload.php" scrolling="no"></iframe>
			</div>
		</div>
		<?}
	else{
		echo "<script>alert(\"Access denied! Contact your administrator to obtain permission.\");</script>";
	}
?>