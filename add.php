Тут добавляется литература преподавателем или библитекарем.<br>
<table border = 0>
	<form action="index.php?action=add" method="POST" id = 'id_form'>
		<tr>
			<td>Название</td>
			<td><input type="text" name="name" ></td>
			<td></td>
		</tr>
		<tr>
			<td>Автор</td>
			<td id = 'authors'>
				<input type="text" name="author" >
				<div id = 'parentID'></div>
			</td>
			<td>
<!--
			<form>
				<input type = 'submit' value = '+' onclick = 'add_new_author()'>
				<input type = 'submit' value = '-' onclick = 'del_new_author()'>
				</form>
-->
				<a href = '#' onclick = 'add_new_author()' ><font size = 5>+</font></a><br>
				<a href = '#' onclick = 'del_new_author()' ><font size = 5>-</font></a>
				
				</td>
		</tr>
		<tr>
			<td>Ссылка</td>
			<td><input type="text" name="reff"></td>
			<td></td>
		</tr>
		<tr>
			<td>Год выпуска</td>
			<td><input type="text" name="year"></td>
			<td></td>
		</tr>
		<tr>
			<td>Количество страниц</td>
			<td><input type="text" name="pages"></td>
			<td></td>
		</tr>
		<tr>
			<td>Издательство</td>
			<td><input type="text" name="publ"></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Опубликовать" name="submit_add" ></td>	
			<td></td>		
		</tr>
	</form>
</table>
<script src = 'add_new_element.js'></script>
<!--
INSERT INTO `price_season` (`begin_season`) VALUES (STR_TO_DATE('2004','11','24', '%Y-%m-%d'));

SELECT something FROM tbl_name
        WHERE TO_DAYS(NOW()) - TO_DAYS(date_col) <= 30;
-->
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
					print_r ($_POST['author']);
					print_r ($_POST['author1']);
					$query = "select * from author where name = '".$_POST['author']."'";
					$sql = mysql_query($query) or die(mysql_error());
					if (mysql_num_rows($sql) > 0){
						echo 'Этот автор уже есть, не добавляю автора';
						$row = mysql_fetch_row($sql);
						$array_of_id_authors[0] = $row[0];
					}else{
						$query = "insert into author (name) values ('".$_POST['author']."')";
						$sql = mysql_query($query) or die(mysql_error());
						$query = "select * from author where name = '".$_POST['author']."'";
						$q = mysql_query($query);
						$row = mysql_fetch_row($q);
						$array_of_id_authors[0] = $row[0];
					}
					if (isset($_POST['author1'])){
						echo 'Второе поле автора активно';
						$query = "select * from author where name = '".$_POST['author1']."'";
						$sql = mysql_query($query) or die(mysql_error());
						if (mysql_num_rows($sql) == 1){
							echo 'Этот автор1 уже есть, не добавляю автора1';
							$row = mysql_fetch_row($sql);
							$array_of_id_authors[1] = $row[0];
						}else{
							$query = "insert into author (`name`) values ('".$_POST['author1']."')";
							$sql = mysql_query($query);
							$query = "select * from author where name = '".$_POST['author1']."'";
							$q = mysql_query($query);
							$row = mysql_fetch_row($q);
							$array_of_id_authors[1] = $row[0];
						}
						if (isset($_POST['author2'])){
							echo 'Третье поле автора активно';
							$query = "select * from author where name = '".$_POST['author2']."'";
							$sql = mysql_query($query) or die(mysql_error());
							if (mysql_num_rows($sql) == 1){
								echo 'Этот автор2 уже есть, не добавляю автора2';
								$row = mysql_fetch_row($sql);
								$array_of_id_authors[2] = $row[0];
							}else{
								$query = "insert into author (`name`) values ('".$_POST['author2']."')";
								$sql = mysql_query($query);
								$query = "select * from author where name = '".$_POST['author2']."'";
								$q = mysql_query($query);
								$row = mysql_fetch_row($q);
								$array_of_id_authors[2] = $row[0];
							}
							if (isset($_POST['author3'])){
								$query = "select * from author where name = '".$_POST['author3']."'";
								$sql = mysql_query($query) or die(mysql_error());
								if (mysql_num_rows($sql) == 1){
									echo 'Этот автор3 уже есть, не добавляю автора3';
									$row = mysql_fetch_row($sql);
									$array_of_id_authors[3] = $row[0];
								}else{
									$query = "insert into author (`name`) values ('".$_POST['author3']."')";
									mysql_query($query);
									$query = "select * from author where name = '".$_POST['author3']."'";
									$q = mysql_query($query);
									$row = mysql_fetch_row($q);
									$array_of_id_authors[3] = $row[0];
								}
							}
						}
					}
					// Здесь мы заполняем таблицу author_resource
					$query = "select * from resource where name = '".$_POST['name']."'";
					$sql = mysql_query($query) or die(mysql_error());
					$row = mysql_fetch_row($sql);
					print_r ($array_of_id_authors);
					for ($i = 0; $i < count($array_of_id_authors); $i++){
						echo '<br>Итераци добавления в author_resource';
						$query = "insert into author_resource 
						values (".$row[0].", ".$array_of_id_authors[$i].")";
						mysql_query($query);
					}
				}
			}
		}
	}
?>
