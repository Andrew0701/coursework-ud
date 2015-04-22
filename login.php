<?php
	header('Content-Type: text/html; charset=utf-8');
	
	function generateCode($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  
		while (strlen($code) < $length) {
				$code .= $chars[mt_rand(0,$clen)];  
		}
		return $code;
	}
	
	
	include_once("connect.php");
	if(isset($_POST['submit'])){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$query = "SELECT id, login, password, access FROM reg WHERE login ='{$login}' AND password='{$password}' LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($sql) == 1){
		
			$data = mysql_fetch_assoc($sql);
		
			# Генерируем случайное число и шифруем его
			$hash = md5(generateCode(10));
				
			# Записываем в БД новый хеш авторизации и IP
			mysql_query("UPDATE reg SET hash='".$hash."' where id='".$data['id']."'") 
				or die ("Не могу выполнить запрос"); 
			
			# Ставим куки
			setcookie("id", $data['id'], time()+60*60*24*30);
			setcookie("hash", $hash, time()+60*60*24*30);
			setcookie("access", $data['access'], time()+60*60*24*30);
			header("Location: index.php");
			echo 'Авторизация прошла успешно \n Вы - '.$data['access'];
		}else
			echo 'Ошибка авторизации';
	}else{
		echo 'Что-то с кнопкой';
	}
?>
