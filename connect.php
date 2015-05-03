 <?php
	header('Content-Type: text/html; charset=utf-8');
	$dblocation = "localhost";
	$dbname = "course_work";
	$dbuser = "root";
	$dbpasswd = "nepnon";
	$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
	mysql_query("SET NAMES 'UTF-8'");
	if (!$dbcnx){
		echo( "<P> Не удалось подключиться к базе данных. </P>" );
		exit();
	}
	if (!@mysql_select_db($dbname, $dbcnx)){
		echo( "<P> Не удалось найти базу данных. .</P>" );
		exit();
	}else{
		mysql_set_charset('utf8',$dbcnx);
	}
?>
