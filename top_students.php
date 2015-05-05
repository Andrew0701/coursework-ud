<b>Список актвных студентов</b>
<?php
	$query = "select reg.login,sum(`count`) from views,reg where reg.id=views.id_reg group by reg.login order by `count` desc limit 5;";
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

