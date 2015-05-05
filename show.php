Страница выставки
<?php
	$query = "select * from `show` where adddate(date_start, interval `time` day) > curdate()";
	include_once("connect.php");
	$q = mysql_query($query) or die(mysql_error());
	
	if ($q){
		echo '<table>';
		while ($row = mysql_fetch_row($q)) {
			echo '<tr>';
			for ($i = 0; $i<count($row); $i++)
				echo '<td>'.$row[$i].'</td>';
			echo '</tr>';
		}
		echo '</table>';
		mysql_free_result($q);
	}
?>
