Страница поиска<br><br>

Ниже расположено окно для сложного запроса:
<form action="index.php?action=search" method="POST">
	<table border = 1>
		<tr>
			<td>
				По автору
			</td>
			<td>
				<input type = 'text' name = 'author'>
			</td>
		</tr>
		<tr>
			<td>
				По названию
			</td>
			<td>
				<input type = 'text' name = 'name'>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="Показать все" name="submit_all">
			</td>
			<td>
				<input type="submit" value="Поиск" name="submit_search">
			</td>
		</tr>
	</table>
	
	
</form>

<?php
	if(isset($_POST['submit_search'])){
		if (empty($_POST['name']) and !empty($_POST['author'])){
			$query = "select * from resource where id_resource in (select id_resource from author_resource where id_author = (select id_author from author where name = '".$_POST['author']."'))";
			include_once("connect.php");
			$q = mysql_query($query) or die(mysql_error());
			
			if ($q){
				if (mysql_num_rows($q) > 0){
					echo '<table>';
					while ($row = mysql_fetch_row($q)) {
						echo '<tr>';
						for ($i = 0; $i<count($row); $i++)
							echo '<td>'.$row[$i].'</td>';
						if ($_COOKIE['access'] == 'Библиотекарь'){
							echo '<td><a href= "#">Выставить</a></td>';
						}
						echo '</tr>';
					}
					echo '</table>';
				}else{
					echo 'Поиск результата не дал';
				}
				mysql_free_result($q);
			}
		}
	}
	if (!empty($_POST['name']) and empty($_POST['author'])){
		$query = "select * from resource where name = '".$_POST['name']."'";
			include_once("connect.php");
			$q = mysql_query($query) or die(mysql_error());
			
			if ($q){
				if (mysql_num_rows($q) > 0){
					echo '<table>';
					while ($row = mysql_fetch_row($q)) {
						echo '<tr>';
						for ($i = 0; $i<count($row); $i++)
							echo '<td>'.$row[$i].'</td>';
						if ($_COOKIE['access'] == 'Библиотекарь'){
							echo '<td><a href= "#">Выставить</a></td>';
						}
						echo '</tr>';
					}
					echo '</table>';
					mysql_free_result($q);
				}else{
					echo 'Поиск результата не дал';
				}
			}
	}
	if (isset($_POST['submit_all'])){
		$query = "select * from resource";
		$sql = mysql_query($query) or die(mysql_error());
		if ($sql){
			if (mysql_num_rows($sql) > 0){
				echo '<table border =1 cellspacing=0>';
				if ($_COOKIE['access'] == 'Библиотекарь'){
					$query = "select id_show,name from `show` where adddate(date_start, interval `time` day) > curdate()";
					include_once("connect.php");
					$q = mysql_query($query) or die(mysql_error());
					if (mysql_num_rows($q)>0){
						$showing = true;
						$c = 0;
						while ($row = mysql_fetch_row($q)){
							$array_of_show[$c++] = $row[0];
							$array_of_show[$c++] = $row[1];
						}
					}else{
						$showing = false;
					}
				}
				while ($row = mysql_fetch_row($sql)) {
					echo '<tr>';
					for ($i = 0; $i<count($row); $i++)
						echo '<td>'.$row[$i].'</td>';
					if ($_COOKIE['access'] == 'Библиотекарь' && $showing){
						
						echo '<td><form name = "s_w"><select name = "name_show">';
						for ($i = 0; $i<count($array_of_show); $i+=2){
							echo "<option value='".$array_of_show[$i]."'>".$array_of_show[$i]."</option>";
						}
						echo '</select></td><td><input name = "submit" type = "submit" value= "Выставить"></form></td>';
					}
					echo '</tr>';
				}
				echo '</table>';
			}else{
				echo 'Поиск результата не дал';
			}
			mysql_free_result($sql);
		}
	}
?>
