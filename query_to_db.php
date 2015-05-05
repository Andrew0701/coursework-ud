Страница поиска<br><br>

Ниже расположено окно для сложного запроса:
<form action="index.php?action=query_to_db" method="POST">
	<textarea rows=5 cols=35 name = 'sql'></textarea><br><br>
	<input type="submit" value="OK" name="submit_sql">
</form>
<br>

<?php
	if(isset($_POST['submit_sql'])){
		$query = $_POST['sql'];
		include_once("connect.php");
		$q = mysql_query($query) or mysql_error();
		try {
			if ($q){
				echo '<h3>Результат запроса:</h3><br>';
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
	}
?>
