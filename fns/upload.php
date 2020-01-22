<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
	<div id="uploadpage">
		<form name="upload" action="" method="POST" ENCTYPE="multipart/form-data"> 
			Выберите файл для загрузки: <br>
			<input type="file" name="userfile">
			<input type="submit" name="upload" value="Загрузить"> <br>
		</form>
		<?
		if (@$_REQUEST['upload']){
			$uploaddir = '../img/upload/';
			$apend=date('ymdHis').rand(1,100).'.png'; 
			$uploadfile = "$uploaddir$apend"; 
			if(($_FILES['userfile']['type'] == 'image/gif' || $_FILES['userfile']['type'] == 'image/jpeg' || $_FILES['userfile']['type'] == 'image/png') && ($_FILES['userfile']['size'] != 0 && $_FILES['userfile']['size'] <= 10485760)) 
			{ 
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){ 
					$size = getimagesize($uploadfile); 
					if ($size[0] < 3201 && $size[1] < 3201){  
						echo "Файл загружен.";?> 
						<input class="rwin" type="text" value="<?=$uploadfile?>"><?
						echo "<script>window.parent.document.richTextField.document.execCommand('insertHTML',false, \"<img src='".$uploadfile."' class='newimg' id='".$apend."' ondblclick='resizeon(id)'>\")</script>"; 
						echo "<script>setTimeout(\"window.parent.document.getElementById('uploadbg').style.display='none'\", 10);</script>";
					}else{
						echo "Загружаемое изображение превышает допустимые нормы (ширина не более - 3200; высота не более 3200)"; 
						unlink($uploadfile); 
					} 
				}else{
					echo "Файл не загружен, вернитеcь и попробуйте еще раз";
				} 
			}else{ 
				echo "Размер файла не должен превышать 1024Кб";
			} 
		}
		?>
		</div>
	</body>
</html>