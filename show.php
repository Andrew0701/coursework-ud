<b>Страница выставки</b><br><br>
<?php
	$query = "select id_show,name,(to_days(adddate(date_start, interval `time` day))-to_days(now())) from `show` where date_start < curdate() and adddate(date_start, interval `time` day) > curdate()";
	include_once("connect.php");
	$sql = mysql_query($query) or die(mysql_error());
	
	if ($sql){
		echo '<table border = 1 cellspacing=0>';
		echo '<tr>
		<td>Название</td>
		<td>Год</td>
		<td>Издательство</td>
		<td>Кол-во стр</td>
		<td>Ссылка</td></tr>';
		while ($row = mysql_fetch_row($sql)) {
			echo '<tr>';
			echo '<td colspan=5><b>'.$row[1].'</b> (осталось '.$row[2].' дня до завершения)</td>';
			echo '</tr>';
			$query = "select id_resource,name,year,publisher,pages,reference from resource where id_resource in (select id_resource from item where id_show = ".$row[0].")";
			$q = mysql_query($query) or die(mysql_error());
			
			if ($q){
				if (mysql_num_rows($q) > 0){
					while ($row = mysql_fetch_row($q)) {
						echo '<tr>';
						for ($i = 1; $i<count($row); $i++)
							echo '<td>'.$row[$i].'</td>';
						echo '</tr>';
						change_views($row[0],$_COOKIE['id']);
					}
				}else{
					echo '<tr><td colspan=5>Выставка пуста</td></tr>';
				}
				mysql_free_result($q);
			}
		}
		echo '</table>';
		mysql_free_result($sql);
	}
	
	function change_views($resource,$id_reg){
		$query = "select count from views where id_resource=".$resource." and id_reg = ".$id_reg;
		$q = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($q) > 0){
			$row = mysql_fetch_row($q);
			$query = "UPDATE `views` SET `count`=".($row[0]+1)." WHERE `id_resource`=".$resource." and `id_reg`=".$id_reg;
			$q = mysql_query($query) or die(mysql_error());
			
		}else{
			$query = "insert into `views` values(".$resource.",".$id_reg.",1)";
			$q = mysql_query($query) or die(mysql_error());
			
		}
	}
?>
