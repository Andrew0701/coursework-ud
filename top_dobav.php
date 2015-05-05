<b>Самые активные заполнители библиотеки:</b>
<?php	
	$query = "select login from reg where id in (select id_reg as count from resource order by count) limit 3";
	include_once("connect.php");
	$q = mysql_query($query) or mysql_error();
	try {
		if ($q){
			echo '<br>';
			echo '<table border=1>';
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
