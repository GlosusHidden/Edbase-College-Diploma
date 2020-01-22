<?
if (isset($_POST['imgtobasket'])){
	$filelist = glob("img/upload/*.png");
    foreach ($filelist as $filename){
		$result1 = mysql_query("select * FROM articles WHERE text RLIKE '$filename' LIMIT 1");
		$count1 = mysql_num_rows($result1);
		$result2 = mysql_query("select * FROM questions WHERE question RLIKE '$filename' LIMIT 1");
		$count2 = mysql_num_rows($result2);
		if ($count1 == 0 and $count2 == 0){
			$newfilename = ereg_replace("upload", "rubbish", $filename);
			$name = ereg_replace("img/upload/", "", $filename);
			if (rename($filename, $newfilename)) echo $name." - Removed <br>";
		}
		mysql_free_result($result1);
		mysql_free_result($result2);
	}
}

if (isset($_POST['freebasket'])){
	$filelist = glob("img/rubbish/*");
    foreach ($filelist as $filename){
		unlink($filename); 
	}
	echo "Recycle bin cleared";
}
?>