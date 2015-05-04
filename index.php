<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Библиотека СевГУ</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="TopMainPan">
  <div id="topPan">
    <div id="topheaderPan"> <a href=""><img src="images/logo.png"height="54" border="0"/></a>
      <p class="captiontext">Онлайн-библиотека СевГУ.</p>
    </div>
    <div id="topbodyleftPan">
      <ul>
        <li><a href = 'index.php'>Главная</a></li>
        <li  class="border"><a href="index.php?action=about">О библиотеке</a></li>
        <?php
			if (isset($_COOKIE['access'])){
				echo "<li><a href='index.php?action=search'>Поиск</a></li>";
				echo "<li><a href='index.php?action=show'>Выставка</a></li>";
				switch ($_COOKIE['access']){
					case 'Преподаватель':
						echo "<li><a href='index.php?action=add'>Добавить</a></li>";
						echo "<li><a href='index.php?action=recom'>Рекомендовать</a></li>";
						break;
					case 'Библиотекарь':
						echo "<li><a href='index.php?action=query_to_db'>Запрос к базе</a></li>";
						echo "<li><a href='index.php?action=add'>Добавить</a></li>";
						echo "<li><a href='index.php?action=showing'>Выставить</a></li>";
						break;
					default:
						break;
				}
			}
        ?>
      </ul>
    </div>
    <div id="topbodycenterPan">
		<?php
			if (isset($_GET['action'])){
				switch($_GET['action']) { //получаем значение переменной action
					case "about":
						require_once("about_about.html");
						break;
					case "search":
						require_once("about_search.html");
						break;
					case "show":
						require_once("about_show.html");
						break;
					case "add":
						require_once("about_add.html");
						break;
					case "showing":
						require_once("about_showing.html");
						break;
					case "recom":
						require_once("about_recom.html");
						break;
					case "reg":
						require_once("about_reg.html");
						break;
					case "in":
						require_once("about_in.html");
						break;
					case "query_to_db":
						require_once("about_query_to_db.html");
						break;
					default:
						echo "Три рандомных слова.";
						break;
				}
			}else{
				require_once("about_main.html");
			}
		?>
    </div>
    <div id="topbodyrightPan">
		<?php
			if (isset($_GET['action'])){
				switch($_GET['action']) { //получаем значение переменной action
					case "in":
						require_once("in.php");
						break;
					case "reg":
						require_once("reg.php");
						break;
					case "log":
						require_once("login.php");
						break;
					default:
						default_autorization();
						break;
				}
			}else{
				default_autorization();
			}
		?>
    </div>
  </div>
</div>
<div id="bodyMainPan">
  <div id="bodyleftPan">
    <?php
		get_body();				
    ?>
   </div>
    <div id='bodyrightPan'>
		<?php
			get_right_content();
		?>
	</div>
  
</div>
<div id="footermainPan">
	<div id = "footerPan">
		&copy; Онлайн-библиотека СевГУ. 2015г.<br>
		Курсовой проект выполнили: Дрозд С. А., Сухоруков М. В., Ульяненко А. О.
	</div>
</div>
</body>
</html>
<?php
	function default_autorization(){
		require_once('connect.php');
		if (isset($_COOKIE['id'])){
			echo "<i>".$_COOKIE['access']."</i> <a href= 'logout.php'>Выход</a><br><br><h2>Данные об учётной записи:</h2><br>";
			switch ($_COOKIE['access']){
				case 'Студент':
					get_student_info();
					break;
				case 'Преподаватель':
					get_teacher_info();
					break;
				case 'Библиотекарь':
					get_librarian_info();
					break;
				default:
					get_banner();
					break;
			}
			
		}else{
			echo "Здравствуй, гость"."<br><a href= 'index.php?action=in'>Войти</a><br><a href= 'index.php?action=reg'>Зарегистрироваться</a>";
		}
	}
	
	function get_student_info() {
		$id = $_COOKIE['id'];
		$query = "SELECT * FROM student WHERE id_reg = ".$id;
		$res = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_row($res);
		
		$query = "SELECT * FROM reg WHERE id = ".$id;
		$res = mysql_query($query) or die(mysql_error());
		$row2 = mysql_fetch_row($res);
		
		$query = "SELECT * FROM direction WHERE id_direction = ".$row[2];
		$res = mysql_query($query) or die(mysql_error());
		$row3 = mysql_fetch_row($res);
		
		echo "<table>";
		echo "<tr>
					<td>Имя:</td>
					<td>".$row2[1]."</td>
				</tr>";
		echo "<tr>
					<td>Направление:</td>
					<td>".$row3[1]."</td>
				</tr>";
		echo "<tr>
					<td>№ зачетной книжки:</td>
					<td>".$row[0]."</td>
				</tr>";
		echo "</table>";
	}
	
	function get_teacher_info() {
		$query = "SELECT login FROM reg WHERE id = ".$_COOKIE['id'];
		$res = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_row($res);
		echo "<table>";
		echo "<tr>
					<td>Имя:</td>
					<td>".$row[0]."</td>
				</tr>";
		mysql_free_result($res);
		
		$query = "SELECT experience FROM teacher WHERE id_reg = ".$_COOKIE['id'];
		$res = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_row($res);
		echo "<tr>
					<td>Опыт:</td>
					<td>".$row[0]."</td>
				</tr>";
		mysql_free_result($res);
		
		$query = "select name from subject where id_subject in 
		(SELECT id_subject FROM teacher_subject WHERE id_reg = ".$_COOKIE['id'].")";
		$res = mysql_query($query) or die(mysql_error());
		echo "<tr>
				<td>Мои предметы:</td>
				<td>";
		while ($row = mysql_fetch_row($res)) {
			echo $row[0].'<br>';
		}
		echo "</td></tr></table>";
		mysql_free_result($res);
	}
	
	function get_librarian_info() {
		$query = "SELECT login FROM reg WHERE id = ".$_COOKIE['id'];
		$res = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_row($res);
		echo "<table>";
		echo "<tr>
					<td>Имя:</td>
					<td>".$row[0]."</td>
				</tr>";
		$query = "SELECT status FROM librarian WHERE id_reg = ".$_COOKIE['id'];
		$res = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_row($res);
		
		echo "<tr>
					<td>Статус:</td>
					<td>".$row[0]." библиотекарь</td>
				</tr>";
		echo "</table>";
	}
	
	function get_body(){
		if (isset($_GET['action'])){
			switch($_GET['action']) { //получаем значение переменной action
				case "about":
					require_once("about.html");
					break;
				case "search":
					require_once("search.php");
					break;
				case "show":
					require_once("show.php");
					break;
				case "add":
					require_once("add.php");
					break;
				case "showing":
					require_once("showing.php");
					break;
				case "recom":
					require_once("recom.php");
					break;
				case "query_to_db":
					require_once("query_to_db.php");
					break;	
				default:
					require_once('main.php');
					break;
			}
		}else{
			require_once('main.php');
		}
	}
	
	function get_right_content(){
		if (isset($_COOKIE['access'])) {
			switch ($_COOKIE['access']) {
				case 'Студент':
					require_once('top_liter.php');
					break;
				case 'Преподаватель':
					require_once('top_students.php');
					break;
				case 'Библиотекарь':
					require_once('top_dobav.php');
					break;
				default:
					get_banner();
					break;
			}
		}else {
			get_banner();
		}
	}

	function get_banner(){
		echo "Тут никогда не будет вашей рекламы";
	}
	//~ function get_student_info() {
		//~ require_once('connect.php');
		//~ $id = $_COOKIE['id'];
		//~ $query = "SELECT * FROM student WHERE id_reg = ".$id;
		//~ $q = mysql_query($query) or die(mysql_error());
		//~ 
		//~ while ($row = mysql_fetch_row($q)) {
			//~ for ($i = 0; $i<count($row); $i++)
				//~ echo $row[$i].'<br>';
		//~ }
		//~ mysql_free_result($q);
		//~ $row = mysql_fetch_row($res);
		//~ echo "Номер зачетной книжки:  ".$row[0]."<br>";
		//~ echo "Имя:  ".$row[3]."<br>";
		//~ echo "Группа:  ".$row[2]."<br>";
	//~ }
?>	
