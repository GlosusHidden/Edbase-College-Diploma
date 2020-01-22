<script>
	function btnnext(a){
		document.getElementById('testnext').value=a;
		document.getElementById('testform').submit();
	}
</script>
<?
if (empty($_SESSION['login'])){
	echo "<script>window.location.href = 'index.php?view=tests';</script>";
}
else{
	if (isset($_POST['question'])){
		$a=$_POST['testnext'];	
		$b=$_POST['question'];	
		$c=$_POST['answer'];	
		$_SESSION[$b]=$c;	
		echo "<script>window.location.href='".$a."'</script>";
	}
	$test=$_GET['test'];
	$result=mysql_query("select * FROM questions WHERE testid='$test' ORDER BY id");
	$myrow = mysql_fetch_array($result);
	$count=mysql_num_rows($result);
	if ($count>'0'){
		?>
		<div id="testpanel">
		<?
		$res=mysql_query("select * FROM tests WHERE id='$test'");
		$row = mysql_fetch_array($res);
		echo '<h3>'.$row['title'].' ('.$row['subject'].')'.'</h3>';
		mysql_free_result($res);
		$questid='0';
		$firstquest=$myrow['id'];
		$quest = empty($_GET['quest']) ? $firstquest : $_GET['quest'];
		if ($quest=='finish'){	
			$rz=0;
			do { 
				$questid=$questid+1;
				$linkquestid=$myrow['id'];
				$sv='t'.$test.'q'.$myrow['id'];
				echo $questid.') ';
				if($_SESSION[$sv]==''){
					echo "Вы пропустили этот вопрос. Правильно: ".$myrow['answer']."<p>";
				}else{
					if($_SESSION[$sv]==$myrow['answer']){
						echo "Вы ответили правильно: <span style='color: #0BD10B;'>".$_SESSION[$sv]."</span><p>";
						$rz=$rz+1;
					}else{
						echo "Вы ответили неправильно: <span style='color: #FF4545;'>".$_SESSION[$sv]."</span> Правильно: ".$myrow['answer']."<p>";
					}
				}
			}while($myrow=mysql_fetch_array($result));
			mysql_free_result($result);
			$rz=round($rz/$questid*100);
			$date = date("d M Y, H:i:s", time()-60*60);
			mysql_query("INSERT INTO results (testid, user, result, date) VALUES ('$test', '$_SESSION[login]', '$rz', '$date')");
			echo "<h3>Ваш результат: ".$rz."%</h3>";
			$user=$_SESSION['login'];
			$type=$_SESSION['type'];
			session_unset();
			$_SESSION['login']=$user;
			$_SESSION['type']=$type;
		?></div><p><?
		}else{
		do { 
			$questid=$questid+1;
			$linkquestid=$myrow['id'];
			if ($linkquestid==$quest){
				$testnavbtn1="testnavbtn1";
			}else {$testnavbtn1="";}
			$sv='t'.$test.'q'.$myrow['id'];
			if (empty($_SESSION[$sv])){
				$testnavbtn2="testnavbtn2";
			}else {$testnavbtn2="";}
			?>	
				<a onclick="btnnext('index.php?view=testing&test=<?=$test?>&quest=<?=$linkquestid?>')" class="testnavbtn <?=$testnavbtn1?> <?=$testnavbtn2?>"><?=$questid;?></a>
		<?
		}while($myrow=mysql_fetch_array($result));
		mysql_free_result($result);
		?><div style="clear:both;"></div><?
		$result=mysql_query("select * FROM questions WHERE testid='$test' AND id='$quest'");
		$myrow = mysql_fetch_array($result);
		?>
			<div id="testpanel">
				<p><?=$myrow['question']?><p>
				<form action="" id="testform" method="post">
					<?$sv='t'.$test.'q'.$myrow['id'];
					$svn=$myrow['id'];?>
					<input type="hidden" name="question" value="<?=$sv?>">	
					<input type="hidden" name="testnext" id="testnext" value="">
					Ответ: <input type="text" name="answer" class="userupdate" value="<?=$_SESSION[$sv]?>">
					<?
						$res=mysql_query("select * FROM questions WHERE testid='$test' AND id>'$svn' LIMIT 1");
						$row = mysql_fetch_array($res);
						$count2=mysql_num_rows($res);
						if ($count2>'0'){
							?><a onclick="btnnext('index.php?view=testing&test=<?=$test?>&quest=<?=$row['id'];?>')" class="commentadd" style="margin: 0px; font-size: 16px; padding: 4px 36px;">Следующий</a><?
						}
						else {?><a onclick="btnnext('index.php?view=testing&test=<?=$test?>&quest=finish')" class="commentadd" style="margin: 0px; font-size: 16px; padding: 4px 36px;">Завершить</a><?}
					?>	
					<div style="clear:both; margin-bottom: 10px;"></div>
				</form>
			</div><p>
			<div style="clear:both;"></div>
		</div><?
		} 
	}
	else{
		echo "<h4 style='padding-left: 10px;'>В данном тесте еще нет вопросов.</h4>";
	}
	mysql_free_result($result);
}?>