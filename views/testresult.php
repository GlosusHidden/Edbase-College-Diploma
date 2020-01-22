<div id='articlepage'>
<?
	$test=$_GET['test'];
	$result=mysql_query("select * FROM tests WHERE id='$test'");
	$myrow = mysql_fetch_array($result);
?>
<h3>Результаты тестирования по теме: <?=$myrow['title'].' ('.$myrow['subject'].')'?></h3><?
$res=mysql_query("select * FROM results WHERE testid='$test' ORDER BY id DESC");
$row = mysql_fetch_array($res);
$count=mysql_num_rows($res);
if ($count>'0'){
?>
	<table id="adminusertable">
		<tr>
			<th width='34%'>Пользователь</th><th width='33%'>Результат</th><th width='33%'>Дата</th></th>
		</tr><?
			do { ?>
					<tr style='padding: 10px;'>
						<td><?=$row['user']?></td>
						<td><?=$row['result']?></td>
						<td><?=$row['date']?></td>
					</tr>	
			<?
			}while($row=mysql_fetch_array($res)); 
?></table>
<?}else
{
	echo "Этот тест еще ни кем не пройден.";
}

?>
</div>