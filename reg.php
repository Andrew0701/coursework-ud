<?php
	header('Content-Type: text/html; charset=utf-8');
?>
<table>
	<form action="reg.php" method="POST">
		<tr>
			<td>Имя</td>
			<td><input type="text" name="login" ></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type="password" name="password" ></td>
		</tr>
		<tr>
			<td>Повторите пароль</td>
			<td><input type="password" name="password2"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email"></td>
		</tr>
		<tr>
			<td><input type="submit" value="OK" name="submit" ></td>
			<td><a href = './in.php'>Войти</a></td>
		</tr>
	</form>
</table>
<?php
	include_once("connect.php");
	if (isset($_POST['submit'])){
		if(empty($_POST['login'])){
			echo 'Введите логин';
		}elseif(empty($_POST['password'])){
			echo 'Введите пароль';
		}elseif(empty($_POST['password2'])){
			echo 'Подтверждение пароля';
		}elseif($_POST['password'] != $_POST['password2']){
			echo 'Пароли не совпадают';
		}elseif(empty($_POST['email'])){
			echo 'Введите E-mail';
		}else{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
			$email = $_POST['email'];
			$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
			$sql = mysql_query($query) or die(mysql_error());
			if (mysql_num_rows($sql) > 0){
				echo 'Ошибка регистрации';
			}else{
				$query = "INSERT INTO reg(login , password , email )
				VALUES ('$login', '$password', '$email')";
				$result = mysql_query($query) or die(mysql_error());
				echo 'Регистрация прошла успешно';
				header("Location: login.php");
			}
		}
	}
