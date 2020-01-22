<?php
		include($_SERVER['DOCUMENT_ROOT'].'/fns/bdconnect.php');
		$title = $_POST['title'];
		$subject = $_POST['subject'];
		$author = $_SESSION['userid'];
		$time = date("d M Y, H:i:s", time()-60*60);
		$text = addslashes($_POST['myTextArea']);
		$editadd = $_POST['editadd'];
		$success = 0;
		$last_id = -1;
		if ($editadd=='0'){
			if (mysql_query("INSERT INTO articles(subject, author, time, title, text, visible) VALUES ('$subject', '$author', '$time', '$title', '$text', '1')")){
				$last_id = mysql_insert_id();
				$success = 1; 
			}
		}
		else {
			$editmun = $_POST['editnum'];
			if (mysql_query("UPDATE articles SET subject='$subject', title='$title', text='$text' WHERE id='$editmun'")){
				$success = 1; 			
			}
		}
		$result = array( 'success' => $success, 'last_id' => $last_id ); 
		echo json_encode($result); 
?>

