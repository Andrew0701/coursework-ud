Тут добавляется литература преподавателем или библитекарем.<br>
<table border = 0>
	<form action="index.php?action=add" method="POST" id = 'id_form'>
		<tr>
			<td>Название</td>
			<td><input type="text" name="name" ></td>
		</tr>
		<tr>
			<td>Автор</td>
			<td id = 'authors'>
				<input type="text" name="author" onfocus = 'onmouseOver()' onblur = 'onmouseOut()'>
				<div id = 'parentID'></div>
			</td>
		</tr>
		<tr>
			<td>Ссылка</td>
			<td><input type="text" name="reff"></td>
		</tr>
		<tr>
			<td>Год выпуска</td>
			<td><input type="text" name="year"></td>
		</tr>
		<tr>
			<td>Количество страниц</td>
			<td><input type="text" name="pages"></td>
		</tr>
		<tr>
			<td>Издательство</td>
			<td><input type="text" name="publ"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Опубликовать" name="submit_add" ></td>
		</tr>
	</form>
</table>
<script>
	function onmouseOver(){
		var div = document.getElementById('parentID');
		str = "Перечислите авторов через запятую";
		div.innerHTML = str;
	}
	function onmouseOut(){
		var div = document.getElementById('parentID');
		div.removeChild(div.firstChild);
	}
</script>

<?php
	if (isset($_POST['submit_add'])){
		if ($_POST['name'] == '' ||
			$_POST['author'] == '' ||
			$_POST['reff'] == '' ||
			$_POST['year'] == '' ||
			$_POST['pages'] == '' ||
			$_POST['publ'] == ''){
			
			echo 'Заполните все поля';
		}else{
			include_once("connect.php");
			$query = "select * from resource where name = '".$_POST['name']."'";
			$sql = mysql_query($query) or die(mysql_error());
			if (mysql_num_rows($sql) > 0){
				echo "Извините, такая литература уже существует";
				return;
			}else{
				$query = "INSERT INTO resource(`id_reg`, `name`, `year`, `publisher`, `pages`, `date_create`, `reference`) 
				VALUES (".$_COOKIE['id'].",'".$_POST['name']."',".$_POST['year'].",'".$_POST['publ']."',".$_POST['pages'].",NOW(),'".$_POST['reff']."')";
				if (mysql_query($query) == false){
					echo 'Ошибка в запросе';
				}else{
					echo 'Всё ок, ресурс добавлен (без автора)';
											// Проверка всех авторов и запись их id в массив array_of_id_authors[]
					
					$authors = split(',',$_POST['author']);
					print_r ($authors);
					$c = 0;
					for ($i = 0; $i < count($authors); $i++){
						$authors[$i] = trim ($authors[$i]);
						$query = "select * from author where name = '".$authors[$i]."'";
						$sql = mysql_query($query) or die(mysql_error());
						if (mysql_num_rows($sql) > 0){
							$row = mysql_fetch_row($sql);
							$array_of_id_authors[$c++] = $row[0];
						}else{
							$query = "insert into author (name) values ('".$authors[$i]."')";
							$sql = mysql_query($query) or die(mysql_error());
							$query = "select * from author where name = '".$authors[$i]."'";
							$q = mysql_query($query);
							$row = mysql_fetch_row($q);
							$array_of_id_authors[$c++] = $row[0];
						}
					}
					// Здесь мы заполняем таблицу author_resource
					$query = "select * from resource where name = '".$_POST['name']."'";
					$sql = mysql_query($query) or die(mysql_error());
					$row = mysql_fetch_row($sql);
					print_r ($array_of_id_authors);
					for ($i = 0; $i < count($array_of_id_authors); $i++){
						$query = "insert into author_resource 
						values (".$row[0].", ".$array_of_id_authors[$i].")";
						mysql_query($query);
					}
				}
			}
		}
	}
?>
