 <?php
	$dblocation = "localhost";
	$dbname = "course_work";
	$dbuser = "root";
	$dbpasswd = "nepnon";
	$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
	if (!$dbcnx){
		echo( "<P> Не удалось подключиться к базе данных. </P>" );
		exit();
	}
	if (!@mysql_select_db($dbname, $dbcnx)){
		echo( "<P> Не удалось найти базу данных. .</P>" );
		exit();
	}
?>
