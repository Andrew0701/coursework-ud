Тут добавляется литература преподавателем или библитекарем.<br>
<table border = 0>
	<form action="index.php?action=add" method="POST">
		<tr>
			<td>Название</td>
			<td><input type="text" name="name" ></td>
			<td></td>
		</tr>
		<tr>
			<td>Автор</td>
			<td id = 'authors'><input type="text" name="author" ></td>
			<td><a onclick = 'add_new_author(this)' ><font size = 5>+</font></a><br>
				<a onclick = 'del_new_author(this)' ><font size = 5>-</font></a></td>
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
			$query = "select * from 'recource' where name = '".$_POST['name']."'";
			if (mysql_num_rows($query) == 1){
				echo "Извините, такая литература уже существует";
				return;
			}
			$query = "INSERT INTO `resource`(`id_reg`, `name`, `year`, `publisher`, `pages`, `date_create`, `reference`) 
			VALUES ('".$_COOKIE['id']."','".$_POST['name']."','".$_POST['year']."','".$_POST['publ']."','".$_POST['pages']."',NOW(),'".$_POST['reff']."')";
			if (mysql_query($query) == false){
				echo 'Ошибка в запросе';
			}else{
				echo 'Всё ок, ресурс добавлен (без автора)';
				$query = "select * from 'author' where name = '".$_POST['author']."'";
			
			}
		}
	}
?>
