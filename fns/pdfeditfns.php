<?
if (isset($_POST['delpdf'])){
	$pdfid = $_POST['pdfid'];
	$result = mysql_query("SELECT * FROM documents WHERE id =".$pdfid);
	$myrow = mysql_fetch_array($result);
	$filename = 'pdf/'.$myrow['adress'].'.pdf';
	unlink($filename);  
	mysql_free_result($result);	
	mysql_query("DELETE FROM documents WHERE id = '$pdfid'");
}
if (isset($_POST['chanpdf'])){
	$name = $_POST['name'];
	$ord = $_POST['order'];
	$pdfid = $_POST['pdfid'];
	mysql_query("UPDATE documents SET name = '$name', ord = '$ord' WHERE id = '$pdfid'");
}
?>