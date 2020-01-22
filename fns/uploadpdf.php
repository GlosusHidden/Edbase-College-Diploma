<?
if (@$_REQUEST['uploadpdf']){
	$newname = $id.'$'.date('ymdHis').rand(1,100);
	$uploadfile = 'pdf/'.$newname.'.pdf'; 
	$filename = basename($_FILES['userfile']['name'], ".pdf");
	if ($_FILES['userfile']['type'] == 'application/pdf' && $_FILES['userfile']['size'] > 0 && $_FILES['userfile']['size'] <= 10485760)
	{ 
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){  
			echo "Файл загружен.";
			$order = $count + 1;
			mysql_query("INSERT INTO documents (article, ord, name, adress) VALUES ('$id', '$order', '$filename', '$newname')");
		}else{
			echo "Файл не загружен, вернитеcь и попробуйте еще раз";
		} 
	}else{ 
		echo "Неверный тип файла или превышен максимально допустимый размер файла";
	} 
}
?>