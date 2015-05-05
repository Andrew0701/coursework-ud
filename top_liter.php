Список рекомендованной литературы от преподавателей
<?php
	$query = "SELECT name,reference
FROM resource
WHERE id_resource in(
SELECT id_resource
FROM recommendation
WHERE id_subject
IN (SELECT id_subject
FROM subject
WHERE id_direction = (

SELECT `group`
FROM student
WHERE id_reg = ".$_COOKIE['id']."
)))";
	include_once("connect.php");
	$q = mysql_query($query) or mysql_error();
	try {
		if ($q){
			if (mysql_num_rows($q)>0){
				echo '<br>';
				echo '<table border=1><tr><td><b>Название</b></td><td><b>Ссылка</b></td></tr>';
				while ($row = mysql_fetch_row($q)) {
					echo '<tr>';
					for ($i = 0; $i<count($row); $i++){
						if ($i == 1) {
							echo '<td><a href="'.$row[$i].'">Скачать</a></td>';
						} else {
							echo '<td>'.$row[$i].'</td>';
						}
					echo '</tr>';
				}
				echo '</table>';
				mysql_free_result($q);
			}else{
				echo 'Ваши преподаватели вам пока ничего не рекомендовали (и пусть будет им стыдно)';
			}
		}
	}
	catch (Exception $e) {
		echo "Exception";
	}
?>
