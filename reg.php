<?php
	header('Content-Type: text/html; charset=utf-8');
?>
<table>
	<form action="index.php?action=reg" method="POST">
		<tr>
			<td>Имя</td>
			<td><input type="text" name="login" ></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type="password" name="password" ></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type="password" name="password2"></td>
		</tr>
		<tr>
			<td>Кто вы?</td>
			<td>
				<select name="status" onchange = 'change(this)'>
					<option value="Студент">Студент</option>
					<option value="Преподаватель">Преподаватель</option>
					<option value="Библиотекарь">Библиотекарь</option>
				</select>
			</td>
		</tr>
		<tr id = 'paste'>
			<td><input type="submit" value="Отправить" name="submit" ></td>
			<td><a href = './index.php?action=in'>Войти</a></td>
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
		}elseif(empty($_POST['group'])){
			echo 'Группа нужна';
		
		
		}else{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
			$email = $_POST['email'];
			$status = $_POST['status'];
			$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
			$sql = mysql_query($query) or die(mysql_error());
			if (mysql_num_rows($sql) > 0){
				echo 'Ошибка регистрации';
			}else{
				$query = "INSERT INTO reg(login , password , email , access)
				VALUES ('$login', '$password', '$email', '$status')";
				$result = mysql_query($query) or die(mysql_error());
				echo 'Регистрация прошла успешно';
				header("Location: index.php?action=in");
			}
		}
	}
?>
