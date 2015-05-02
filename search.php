Страница поиска<br><br>

Ниже расположено окно для сложного запроса:
<form action="index.php?action=search" method="POST">
	<input type ='text' name = 'sql'>
	<input type="submit" value="OK" name="submit_sql">
</form>

<?php
	if(isset($_POST['submit_sql'])){
		$query = $_POST['sql'];
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
	}
?>
