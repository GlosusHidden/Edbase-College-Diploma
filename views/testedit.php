<?if ($_SESSION['type']=='0'){?>
<body onLoad="iFrameEdit()">
	<?
		if ((isset($_POST['typeaction'])) and (empty($_POST['deltestquest']))){
			$id=$_POST['testnext'];	
			$testid=$_GET['test'];	
			$question=$_POST['myTextArea'];	
			$answer=$_POST['answer'];
			$type=$_POST['typeaction'];
			if ($type=="add"){
				mysql_query("INSERT INTO questions (testid, question, answer) VALUES ('$testid','$question','$answer')");
			}
			if ($type=="update"){
				mysql_query("UPDATE questions SET testid='$testid', question='$question', answer='$answer'  WHERE id='$id'");
			}
				
		}
		if (isset($_POST['deltestquest'])){
			$id=$_POST['testnext'];	
			mysql_query("DELETE FROM questions WHERE id='$id'");
			$test=$_GET['test'];
			echo "<script>window.location.href='index.php?view=testedit&test=".$test."&quest=add'</script>";
		}	
		function quest($myrow)
		{
			$firstquest=$myrow['id'];			
			$quest = empty($_GET['quest']) ? $firstquest : $_GET['quest'];
			?>		
			<div id="article" style="background: #E2E2E2; padding: 7px;">	
				<form action="" name="myform" id="myform" method="post">
					<?include($_SERVER['DOCUMENT_ROOT'].'/views/editpanel.php');?>
					<input type="range" min="0" max="1000" step="1" oninput="resize(value, name)" onblur="this.style.display='none'" style="display: none" id="imgrange">
					<input type="hidden" value="<?=addslashes(htmlspecialchars($myrow['question']))?>" id="hiddentext">
					<textarea style="display:none;" name="myTextArea" id="myTextArea" cols="36" rows="8"></textarea>
					<iframe src="fns/richTextField.php" name="richTextField" id="richTextField" style="margin-bottom: 5px;"></iframe>	
					Ответ: <input type="text" name="answer" class="userupdate" value="<?=$myrow['answer']?>" style="margin-bottom: 0px;">
					<?if (($quest=='add') or (empty($quest))){?>
						<input type="hidden" value="add" name="typeaction">
						<input type="button" class="commentadd" name="addtestquest" style="margin: 0px; font-size: 16px; padding: 4px 36px;" value="Добавить" onClick="javascript:submit_form2();">		
					<?}else{?>
						<input type="hidden" name="testnext" id="testnext" value="<?=$quest?>">
						<input type="hidden" value="update" name="typeaction">
						<input type="button" class="commentadd" name="updatetestquest" style="margin: 0px; font-size: 16px; padding: 4px 36px;" value="Сохранить" onClick="javascript:submit_form2();">	
						<input type="submit" class="commentadd" name="deltestquest" style="margin-right: 10px; font-size: 16px; padding: 4px 36px;" value="Удалить">
					<?}?>	
				</form>
			</div><p>
			<div id="uploadbg">
				<div id="uploadwindow">
					<div class="rwtitle">Загрузка изображения</div><img src="img/icons/close.png" onmouseover="this.src='img/icons/close2.png'" onmouseout="this.src='img/icons/close.png'" onclick="uploadoff()" class="rwexitbtn">
						<iframe src="fns/upload.php" scrolling="no"></iframe>
				</div>
			</div>
			<?
		}	
		$test=$_GET['test'];
		$result=mysql_query("select * FROM questions WHERE testid='$test' ORDER BY id");
		$myrow = mysql_fetch_array($result);
		$count=mysql_num_rows($result);
			?>
			<div id="article" style="margin-top: 10px;">
			<?
			$res=mysql_query("select * FROM tests WHERE id='$test'");
			$row = mysql_fetch_array($res);
			echo '<h3>'.$row['title'].' ('.$row['subject'].')'.'</h3>';
			mysql_free_result($res);
			if ($count>'0'){
			$questid='0';
			$firstquest=$myrow['id'];
			$quest = empty($_GET['quest']) ? $firstquest : $_GET['quest'];
			do { 
				$questid=$questid+1;
				$linkquestid=$myrow['id'];
				$sv='t'.$test.'q'.$myrow['id'];
				?>	
					<a href="index.php?view=testedit&test=<?=$test?>&quest=<?=$linkquestid?>" class="testnavbtn"><?=$questid;?></a>
			<?
			}while($myrow=mysql_fetch_array($result));
			mysql_free_result($result);}
			?>
			<a href="index.php?view=testedit&test=<?=$test?>&quest=add" class="testnavbtn">+</a>
			<div style="clear:both;"></div>			
			<?
				$result=mysql_query("select * FROM questions WHERE testid='$test' AND id='$quest'");
				$myrow = mysql_fetch_array($result);
				quest($myrow);
				mysql_free_result($result);
			?>					
			<div style="clear:both;"></div>
		</div><?
	
}?>