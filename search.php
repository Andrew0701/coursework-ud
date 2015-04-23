Страница поиска<br><br>

Ниже расположено окно для сложного запроса:
<form action="index.php?action=search" method="POST">
	<input type ='text' name = 'sql'>
	<input type="submit" value="OK" name="submit_sql">
</form>

<?php
	if(isset($_POST['submit_sql'])){
		echo $_POST['sql'];
	}
?>
