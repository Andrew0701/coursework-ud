Поиск можно осуществить по называнию произведения или по авторам.
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
			$query = "select * from resource where id_resource in (select id_resource from author_resource where id_author = (select id_author from author where name = '".$_POST['author']."'))";
			include_once("connect.php");
			$q = mysql_query($query) or die(mysql_error());
			
			if ($q){
				if (mysql_num_rows($q) > 0){
					echo '<table>';
					$array_of_show = check_show();
					while ($row = mysql_fetch_row($q)) {
						echo '<tr>';
						for ($i = 0; $i<count($row); $i++)
							echo '<td>'.$row[$i].'</td>';
						if ($_COOKIE['access'] == 'Библиотекарь'){
							echo '<td><a href= "#">Выставить</a></td>';
						}
						check_librarian($array_of_show);
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
					$array_of_show = check_show();
					while ($row = mysql_fetch_row($q)) {
						echo '<tr>';
						for ($i = 0; $i<count($row); $i++)
							echo '<td>'.$row[$i].'</td>';
						if ($_COOKIE['access'] == 'Библиотекарь'){
							echo '<td><a href= "#">Выставить</a></td>';
						}
						check_librarian($array_of_show);
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
				$array_of_show = check_show();
				while ($row = mysql_fetch_row($sql)) {
					echo '<tr>';
					for ($i = 0; $i<count($row); $i++)
						echo '<td>'.$row[$i].'</td>';
					check_librarian($array_of_show);
					echo '</tr>';
				}
				echo '</table>';
			}else{
				echo 'Поиск результата не дал';
			}
			mysql_free_result($sql);
		}
	}
	
	function check_show(){
		if ($_COOKIE['access'] == 'Библиотекарь'){
			$query = "select id_show,name from `show` where adddate(date_start, interval `time` day) > curdate()";
			include_once("connect.php");
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

	function check_librarian($array_of_show){
		if ($_COOKIE['access'] == 'Библиотекарь' && count($array_of_show)>1){
			echo '<td><form name = "s_w"><select name = "name_show">';
			for ($i = 0; $i<count($array_of_show); $i+=2){
				echo "<option value='".$array_of_show[$i]."'>".$array_of_show[$i+1]."</option>";
			}
			echo '</select></td><td><input name = "submit" type = "submit" value= "Выставить"></form></td>';
		}
	}
?>
