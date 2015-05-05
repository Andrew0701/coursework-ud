Страница рекомендация
<?php
	$query = "select id_resource,id_subject from recommendation  where id_reg = ".$_COOKIE['id'];
	include_once("connect.php");
	$q = mysql_query($query) or mysql_error();
	if ($q){
		echo '<br>';
		echo '<table border=1>';
		echo '<tr><td><b>Рекомендован</b></td><td><b>По предмету</b></td>';
		while ($row = mysql_fetch_row($q)) {
			$query1 = "select name from resource  where id_resource = ".$row[0];
			$sql1 = mysql_query($query1) or mysql_error();
			$query2 = "select name from subject  where id_subject = ".$row[1];
			$sql2 = mysql_query($query1) or mysql_error();
			
			if ($sql1 && $sql2){
				$resource = mysql_fetch_row($sql1);
				$subject = mysql_fetch_row($sql2);
				echo '<tr><td>'.$resource[0].'</td><td>'.$subject[0].'</td></tr>';
			}
			mysql_free_result($sql1);
			mysql_free_result($sql2);
		}
		echo '</table>';
		mysql_free_result($q);
	}
?>

