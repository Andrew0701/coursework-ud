<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>GuldeLine</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="TopMainPan">
  <div id="topPan">
    <div id="topheaderPan"> <a href=""><img src="images/logo.gif" alt="Gulde Line" width="228" height="54" border="0" title="Gulde Line" /></a>
      <p class="captiontext">Какой-то текст рядом с логотопом.</p>
    </div>
    <div id="topbodyleftPan">
      <ul>
        <li class="home"><a href = 'index.php'>Главная</a></li>
        <li><a href="index.php?action=about">О библиотеке</a></li>
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
    <div id="topbodyrightPan">
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
					default:
						echo "Описание главной страницы";
						break;
				}
			}else{
				echo "Описание главной страницы";
			}
		?>
    </div>
    <div>
		<?php
			if (isset($_GET['action'])){
				switch($_GET['action']) { //получаем значение переменной action
					case "in":
						require_once("in.php");
						break;
					case "reg":
						require_once("reg.php");
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
  <div id="bodyPan">
    
  </div>
</div>
<div id="footermainPan">

</div>
</body>
</html>
<?php
	function default_autorization(){
		if (isset($_COOKIE['id'])){
			echo $_COOKIE['access']." <a href= 'logout.php'>Выход</a>";
		}else{
			echo "Здравствуй, гость"."<br><a href= 'index.php?action=in'>Войти</a><br><a href= 'index.php?action=reg'>Зарегистрироваться</a>";
		}
	}
?>	
