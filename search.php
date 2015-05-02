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
		echo mysql_result($q,1);
		if ($q){
			//~ while ($row = mysql_fetch_object($q)) {
				//~ echo $row->id." ";
				//~ echo $row->login."<br>";
			//~ }
			while ($row = mysql_fetch_array($q, MYSQL_ASSOC)) {
				echo $row["name"];
			}	
			
			mysql_free_result($q);
		}
	}
?>
