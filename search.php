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
<br>

<?php
	if(isset($_POST['submit_search'])){
		if (empty($_POST['name']) and !empty($_POST['author'])){
			$query = "select * from resource where id_resource in (select id_resource from author_resource where id_author = (select id_author from author where name = '".$_POST['author']."'))";
			include_once("connect.php");
			$q = mysql_query($query) or die(mysql_error());
			
			if ($q){
				
				echo '<table border = 1>';
				while ($row = mysql_fetch_row($q)) {
					echo '<tr>';
					for ($i = 0; $i<count($row); $i++)
						echo '<td>'.$row[$i].'</td>';
					echo '</tr>';
				}
				echo '</table>';
				mysql_free_result($q);
			}
		}
	}
	if (!empty($_POST['name']) and empty($_POST['author'])){
		$query = "select * from resource where name = '".$_POST['name']."'";
			include_once("connect.php");
			$q = mysql_query($query) or die(mysql_error());
			
			if ($q){
				echo '<table border = 1>';
				while ($row = mysql_fetch_row($q)) {
					echo '<tr>';
					for ($i = 0; $i<count($row); $i++)
						echo '<td>'.$row[$i].'</td>';
					echo '</tr>';
				}
				echo '</table>';
				mysql_free_result($q);
			}
	}
	if (isset($_POST['submit_all'])){
		$query = "select * from resource";
		$q = mysql_query($query) or die(mysql_error());
		if ($q){
			
			echo '<table border = 1>';
			while ($row = mysql_fetch_row($q)) {
				echo '<tr>';
				for ($i = 0; $i<count($row); $i++)
					echo '<td>'.$row[$i].'</td>';
				echo '</tr>';
			}
			echo '</table>';
			mysql_free_result($q);
		}
	}
?>
