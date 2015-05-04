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
				<select id="select" name="statut" onchange = "changeFields()">
					<option value="Студент">Студент</option>
					<option value="Преподаватель">Преподаватель</option>
					<option value="Библиотекарь">Библиотекарь</option>
				</select>
			</td>
		</tr>
		<tr class="hidden" name="student">
			<td>Направление</td>
			<td><select name="spec">
			
				<?php
					include_once("connect.php");
					$query = "SELECT * FROM direction";
					$q = mysql_query($query) or die(mysql_error());
					try {
						if ($q){
							while ($row = mysql_fetch_row($q)) {
								$direction[$row[1]] = $row[0];
								echo "<option value='".$row[0]."'>".$row[1]."</option>";
							}
							mysql_free_result($q);
						}
					}
					catch (Exception $e) {
						echo "Exception";
					}
				?>
			</select>
			
			</td>
		</tr>
		<tr class="hidden" name="student">
			<td>Номер зач. кн.</td>
			<td><input  type="text" name="no_kn"></td>
		</tr>
		<tr class="hidden" name="prepod">
			<td>Список дисциплин</td>
			<td><input  type="text" name="subjects" onfocus = 'onmouseOver()' onblur = 'onmouseOut()'>
			<div id = 'parentID'></div></td>
		</tr>
		<tr class="hidden" name="prepod">
			<td>Стаж</td>
			<td><input  type="text" name="experience"></td>
		</tr>
		<tr class="hidden" name="librarian">
			<td>Статус</td>
			<td>
				<select id="select" name="status">
					<option value="Младший">Младший</option>
					<option value="Старший">Старший</option>
				</select>
			</td>
		</tr>
		<div id = 'paste'></div>
		<tr>
			<td><input type="submit" value="Отправить" name="submit" ></td>
			<td><a href = './index.php?action=in'>Войти</a></td>
		</tr>
	</form>
</table>

<script>
	function onmouseOver(){
		var div = document.getElementById('parentID');
		str = "Через запятую";
		div.innerHTML = str;
	}
	function onmouseOut(){
		var div = document.getElementById('parentID');
		div.removeChild(div.firstChild);
	}
</script>

<script>
function hideAll(rawNames) {
	for (i in rawNames) {
		rawsToHide = document.getElementsByName(rawNames[i])
		for (i in rawsToHide) {
			if (typeof rawsToHide[i] == "object") {
				rawsToHide[i].setAttribute("class","hidden")
			}
		}
	}
}
function changeFields() {
	rawNames = {'Студент':'student','Преподаватель':'prepod','Библиотекарь':'librarian'}
	selectedRawName = document.getElementById("select").value
	rawsToShow = document.getElementsByName(rawNames[selectedRawName])
	
	hideAll(rawNames)
	
	for (i in rawsToShow) {
		if (typeof rawsToShow[i] == "object") {
			rawsToShow[i].setAttribute("class","visible")
		}
	}
}
	
		
</script>

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
						
						echo 'Регистрация прошла успешно';
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
						print_r ($subjects);
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
						echo "<br> Вставляем в reg";
						$query = "INSERT INTO reg(login , password , access)
						VALUES ('$login', '$password', '$status')";
						$result = mysql_query($query) or die(mysql_error());
						echo "<br> Проверяем id";
						$query = "SELECT `id` FROM `reg` WHERE `login`='{$login}' AND `password`='{$password}'";
						$result = mysql_query($query) or die(mysql_error());
						$row = mysql_fetch_row($result);//row[0] - id пользователя в таблице reg
						echo "<br> Вставляем в teacher";
						$query = "INSERT INTO teacher(id_reg, experience)
						VALUES (".$row[0].",".$_POST['experience'].")";
						$sql = mysql_query($query) or die(mysql_error());
						echo "<br> Вставляем в teacher_subject";
								// Здесь мы заполняем таблицу teacher_subject
						for ($i = 0; $i < count($array_of_id_subjects); $i++){
							echo "<br> Iteration";
							$query = "insert into teacher_subject
							values (".$row[0].", ".$array_of_id_subjects[$i].")";
							mysql_query($query);
						}
						
						echo 'Регистрация прошла успешно';
						header("Location: index.php?action=in");
					}
					break;
				case 'Библиотекарь':
					if (empty($_POST['status'])){
						echo 'Необходимо свой статус указать';
						return;
					}
					//		echo 'Обработка библиотекаря';
					
					break;
				default:
					break;
			}
		}
	}
?>
