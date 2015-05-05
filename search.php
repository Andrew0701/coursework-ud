<b>Поиск можно осуществить по называнию произведения или по авторам.</b>
<br><br>
<form action="index.php?action=search" method="POST">
	<table>
		<tr>
			<td width=100>По автору</td>
			<td><input type = 'text' name = 'author'></td>
		</tr>
		<tr>
			<td>По названию</td>
			<td><input type = 'text' name = 'name'></td>
		</tr>
		<tr>
			<td><input type="submit" value="Поиск" name="submit_search"></td>
			<td></td>		
		</tr>
		<tr>
			<td><input type="submit" value="Показать все" name="submit_all"></td>
			<td></td>		
		</tr>
	</table>
	
	
</form>

<?php
	if(isset($_POST['submit_search'])){
		if (empty($_POST['name']) and !empty($_POST['author'])){
			$query = "select id_resource,name,year,publisher,pages,reference from resource where id_resource in (select id_resource from author_resource where id_author = (select id_author from author where name = '".$_POST['author']."'))";
			get_resource($query);
		}
		if (!empty($_POST['name']) and empty($_POST['author'])){
			$query = "select id_resource,name,year,publisher,pages,reference from resource where name = '".$_POST['name']."'";
			get_resource($query);
		}
		
	}
	if (isset($_POST['submit_all'])){
		$query = "select id_resource,name,year,publisher,pages,reference from resource";
		get_resource($query);
	}
	
	function get_resource($query){
		include_once("connect.php");
		$q = mysql_query($query) or die(mysql_error());
		
		if ($q){
			if (mysql_num_rows($q) > 0){
				echo '<br><h3>Результат поиска:</h3><br>';
				echo '<table border=1>';
				echo '<tr>
				<td>Название</td>
				<td>Год</td>
				<td>Издательство</td>
				<td>Кол-во страниц</td>
				<td>Ссылка</td>';
				$array_of_id = check_show(); //Получение id и названия актуальных выставок
				echo '</tr>';
				while ($row = mysql_fetch_row($q)) {
					echo '<tr>';
					for ($i = 1; $i<count($row); $i++)
						echo '<td>'.$row[$i].'</td>';
					change_views($row[0],$_COOKIE['id']); // Отправляем данные в views
					check_user($array_of_id,$row[0]); // Вывод доп меню для библиотекаря
					echo '</tr>';
				}
				echo '</table>';
			}else{
				echo 'Поиск результата не дал';
			}
			mysql_free_result($q);
		}
	}
	
	function change_views($resource,$id_reg){
		$query = "select count from views where id_resource=".$resource." and id_reg = ".$id_reg;
		$q = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($q) > 0){
			$row = mysql_fetch_row($q);
			$query = "UPDATE `views` SET `count`=".($row[0]+1)." WHERE `id_resource`=".$resource." and `id_reg`=".$id_reg;
			$q = mysql_query($query) or die(mysql_error());
			
		}else{
			$query = "insert into `views` values(".$resource.",".$id_reg.",1)";
			$q = mysql_query($query) or die(mysql_error());
		}
	}
	
	function check_show(){
		if ($_COOKIE['access'] == 'Библиотекарь'){
			echo '<td colspan=2>Доступные выставки</td>';
			$query = "select id_show,name from `show` where adddate(date_start, interval `time` day) > curdate()";
			$q = mysql_query($query) or die(mysql_error());
			if (mysql_num_rows($q)>0){
				$c = 0;
				while ($row = mysql_fetch_row($q)){
					$array_of_show[$c++] = $row[0];
					$array_of_show[$c++] = $row[1];
				}
				return $array_of_show;
			}else{
				return false;
			}
		}elseif ($_COOKIE['access'] == 'Преподаватель'){
			echo '<td colspan=2>Рекомендовать</td>';
			$query = "select id_subject,name from `subject` where id_subject = (select id_subject from teacher_subject where id_reg =".$_COOKIE['id'].")";
			$q = mysql_query($query) or die(mysql_error());
			if (mysql_num_rows($q)>0){
				$c = 0;
				while ($row = mysql_fetch_row($q)){
					$array_of_show[$c++] = $row[0];
					$array_of_show[$c++] = $row[1];
				}
				return $array_of_show;
			}else{
				return false;
			}
		}
	}

	function check_user($array_of_id,$resource){
		if (count($array_of_id)>1){
			if ($_COOKIE['access'] == 'Библиотекарь'){
				echo '<td><form name = "s_w" method = "POST" action = "index.php?action=search">
				<select name = "name_show">';
				for ($i = 0; $i<count($array_of_id); $i+=2){
					echo "<option value='".$array_of_id[$i]."'>".$array_of_id[$i+1]."</option>";
				}
				echo '</select></td>
				<td><input type = "hidden" name= "resource" value = "'.$resource.'">
				<input class = "btm" name = "submit_show" type = "submit" value= "Выставить"></form></td>';
			}elseif($_COOKIE['access'] == 'Преподаватель'){
				echo '<td><form name = "s_w" method = "POST" action = "index.php?action=search">
				<select name = "name_show">';
				for ($i = 0; $i<count($array_of_id); $i+=2){
					echo "<option value='".$array_of_id[$i]."'>".$array_of_id[$i+1]."</option>";
				}
				echo '</select></td>
				<td><input type = "hidden" name= "resource" value = "'.$resource.'">
				<input class = "btm" name = "submit_show" type = "submit" value= "Выставить"></form></td>';
			}
		}
	}
	
	if (isset($_POST['submit_show'])){
		switch($_COOKIE['access']){
			case 'Библиотекарь':
				$query = "select * from item where id_resource = ".$_POST['resource']." and id_show = ".$_POST['name_show'];
				$q = mysql_query($query) or die(mysql_error());
				if (mysql_num_rows($q) > 0){
					echo "Не получилось, уже такой есть";
				}else{
					$query = "insert into item values (".$_POST['name_show'].",".$_POST['resource'].")";
					$q = mysql_query($query) or die(mysql_error());
					echo 'Источник добавлен';
				}
				break;
			case 'Преподаватель':
				$query = "select * from recommendation where id_resource = ".$_POST['resource']." and id_reg = ".$_COOKIE['id'];
				$q = mysql_query($query) or die(mysql_error());
				if (mysql_num_rows($q) > 0){
					echo "Не получилось, уже рекомендовано";
				}else{
					$query = "insert into recommendation values (".$_COOKIE['id'].",".$_POST['resource'].",".$_POST['name_show'].")";
					$q = mysql_query($query) or die(mysql_error());
					echo 'Рекомендован';
				}
				break;
			default:
				break;
		}
	}
?>
