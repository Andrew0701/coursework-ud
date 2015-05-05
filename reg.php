<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once("form.php");
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
		}else{
			switch($_POST['statut']){
				case 'Студент':
					if (empty($_POST['spec'])){
						echo 'Выбери группу';
						return;
					}
					if (empty($_POST['no_kn'])){
						echo 'Необходима зачётная книжка';
						return;
					}
					//			echo 'Обработка студента';
					$login = $_POST['login'];
					$password = $_POST['password'];
					$status = $_POST['statut'];
					$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
					$sql = mysql_query($query) or die(mysql_error());
					if (mysql_num_rows($sql) > 0){
						echo 'Ошибка регистрации';
					}else{
						$query = "INSERT INTO reg(login , password , access)
						VALUES ('$login', '$password', '$status')";
						$result = mysql_query($query) or die(mysql_error());
						
						$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
						$result = mysql_query($query) or die(mysql_error());
						$row = mysql_fetch_row($result);//row[0] - id пользователя в таблице reg
						
						$query = "INSERT INTO student(n_record_book, id_reg, `group`)
						VALUES (".$_POST['no_kn'].",".$row[0].",".$_POST['spec'].")";
						$sql = mysql_query($query) or die(mysql_error());
						
						header("Location: index.php?action=in");
					}
						
					break;
				case 'Преподаватель':
					if (empty($_POST['subjects'])){
						echo 'Выбери список сопровождаемых дисциплин (через запятую)';
						return;
					}
					if (empty($_POST['experience'])){
						echo 'Необходимо уазать опыт работы';
						return;
					}
					//		echo 'Обработка преподавателя';
					$login = $_POST['login'];
					$password = $_POST['password'];
					$status = $_POST['statut'];
					$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
					$sql = mysql_query($query) or die(mysql_error());
					if (mysql_num_rows($sql) > 0){
						echo 'Ошибка регистрации';
					}else{
						
						$subjects = split(',',$_POST['subjects']);
						$c = 0;
						for ($i = 0; $i < count($subjects); $i++){
							$subjects[$i] = trim ($subjects[$i]);
							$query = "select * from subject where name = '".$subjects[$i]."'";
							$sql = mysql_query($query) or die(mysql_error());
							if (mysql_num_rows($sql) > 0){
								$row = mysql_fetch_row($sql);
								$array_of_id_subjects[$c++] = $row[0];
							}else{
								echo "Нет такой дисциплины: ".$subjects[$i];
								exit();
							}
						}
						$query = "INSERT INTO reg(login , password , access)
						VALUES ('$login', '$password', '$status')";
						$result = mysql_query($query) or die(mysql_error());
						
						$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
						$result = mysql_query($query) or die(mysql_error());
						$row = mysql_fetch_row($result);//row[0] - id пользователя в таблице reg
						
						$query = "INSERT INTO teacher(id_reg, experience)
						VALUES (".$row[0].",".$_POST['experience'].")";
						$sql = mysql_query($query) or die(mysql_error());
						
								// Здесь мы заполняем таблицу teacher_subject
						for ($i = 0; $i < count($array_of_id_subjects); $i++){
							$query = "insert into teacher_subject
							values (".$row[0].", ".$array_of_id_subjects[$i].")";
							mysql_query($query);
						}
						
						header("Location: index.php?action=in");
					}
					break;
				case 'Библиотекарь':
					//		echo 'Обработка библиотекаря';
					$login = $_POST['login'];
					$password = $_POST['password'];
					$status = $_POST['statut'];
					$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
					$sql = mysql_query($query) or die(mysql_error());
					if (mysql_num_rows($sql) > 0){
						echo 'Ошибка регистрации';
					}else{
						echo "<br> Вставляем в reg";
						$query = "INSERT INTO reg(login , password , access)
						VALUES ('$login', '$password', '$status')";
						$sql = mysql_query($query) or die(mysql_error());
						
						$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
						$sql = mysql_query($query) or die(mysql_error());
						$row = mysql_fetch_row($sql);
						
						$query = "INSERT INTO librarian(id_reg, status)
						VALUES (".$row[0].",'".$_POST['status']."')";
						$sql = mysql_query($query) or die(mysql_error());
						
						header("Location: index.php?action=in");
					}
					break;
				default:
					break;
			}
		}
	}
?>
