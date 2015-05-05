<b>Список актвных студентов</b>
<?php
	$query = "select reg.login, views.count from reg,views where reg.id in(select id_reg from views order by count) limit 3";
	include_once("connect.php");
	$q = mysql_query($query) or mysql_error();
	try {
		if ($q){
			echo '<br>';
			echo '<table border=0>';
			echo '<tr>
			<td>Имя</td>
			<td>Кол-во просмотров</td>
			</tr>';
			while ($row = mysql_fetch_row($q)) {
				echo '<tr>';
				for ($i = 0; $i<count($row); $i++)
					echo '<td>'.$row[$i].'</td>';
				echo '</tr>';
			}
			echo '</table>';
			mysql_free_result($q);
		}
	}
	catch (Exception $e) {
		echo "Exception";
	}
?>

