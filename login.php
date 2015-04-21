<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once("connect.php");
	if(isset($_POST['submit'])){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$query = "SELECT id, login, password FROM reg WHERE login ='{$login}' AND password='{$password}' LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($sql) == 1)
			echo 'Авторизация прошла успешно';
		else
			echo 'Ошибка авторизации';
	}else{
		echo 'Что-то с кнопкой';
	}
?>
