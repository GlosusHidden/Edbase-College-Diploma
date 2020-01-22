<?	
	if (($_SESSION['type'] == '0') or ($_SESSION['type'] == '1')){
		include($_SERVER['DOCUMENT_ROOT'].'/fns/pdfeditfns.php');
		$id=$_GET['id'];
		$result = mysql_query("select * FROM articles WHERE id='$id'");
		$myrow = mysql_fetch_array($result);
?>
		<div id="pdfpage">
				<h3>Прикрепленные документы (<?=$myrow['title']?>):</h3>
				<form name="uploadpdf" action="" method="POST" ENCTYPE="multipart/form-data" class = "newpdfform"> 
					Добавить новый файл: 
					<input type = "file" name = "userfile" class = "uploadinput">
					<input type = "submit" name = "uploadpdf" value = "Загрузить"  class = "uploadinput">
				</form>
				<?
				$res = mysql_query("select * FROM documents WHERE article='$id'");
				$count = mysql_num_rows($res);
				include($_SERVER['DOCUMENT_ROOT'].'/fns/uploadpdf.php');
				mysql_free_result($res);	
				$res = mysql_query("select * FROM documents WHERE article='$id' ORDER BY ord");
				$row = mysql_fetch_array($res);	
				$count = mysql_num_rows($res);				
				if ($count > '0'){?>
					<h3>Ранее добавленные файлы:</h3>				
					
					<?do{?>
					<form action="" method="POST" name="editpdf">
					<table class = "pdfpagetable">
						<tr>	
							<input type="hidden" name="pdfid" value="<?=$row['id']?>">
							<td class = "pdfpagetablename"><input type = "text" value = "<?=$row['name'];?>" title = "Name" name = "name"></td>
							<td class = "pdfpagetabletd"><input type = "text" value = "<?=$row['ord'];?>" title = "Order" name = "order"></td>
							<td class = "pdfpagetabletd">
								<button type="submit" name="chanpdf" title="Save" class="admbigbtn">
									<img src="img/icons/save.png" onmouseover="this.src='img/icons/save2.png'" onmouseout="this.src='img/icons/save.png'">
								</button>						
							</td>
							<td class = "pdfpagetabletd">
								<a href="pdf/<?=$row['adress']?>.pdf"  target="_blank" title="Open">
									<img src="img/icons/newtab.png" onmouseover="this.src='img/icons/newtab2.png'" onmouseout="this.src='img/icons/newtab.png'">
								</a>						
							</td>
							<td class = "pdfpagetabletd">
								<button type="submit" name="delpdf" title="Delete" class="admbigbtn">
									<img src="img/icons/delete.png" onmouseover="this.src='img/icons/delete2.png'" onmouseout="this.src='img/icons/delete.png'">
								</button>						
							</td>
						<tr>
					</table>
					</form>
					<?
					} while($row = mysql_fetch_array($res));
				}
		?>					
		</div>		
<?	
	mysql_free_result($result);
	mysql_free_result($res);
	}
	else{
		echo "<script>alert(\"Access denied! Contact your administrator to obtain permission.\");</script>";
	}
?>