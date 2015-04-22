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
    <div id="topheaderPan"> <a href="http://web-mastery.info/"><img src="images/logo.gif" alt="Gulde Line" width="228" height="54" border="0" title="Gulde Line" /></a>
      <p class="captiontext">Lorem ipsum dolorsit nunc. Lorem ipsum</p>
    </div>
    <div id="topbodyleftPan">			<!-- Меню -->
      <ul>
        <li class="home">main page</li>
        <li><a href="http://web-mastery.info/">About us</a></li>
        <li><a href="http://web-mastery.info/">main solutions</a></li>
        <li><a href="http://web-mastery.info/">books selling</a></li>
        <li><a href="http://web-mastery.info/">our support</a></li>
        <li class="contact"><a href="http://web-mastery.info/">Contact us</a></li>
      </ul>
    </div>
    <div id="topbodyrightPan">			<!-- Описание -->
      <h2>highlight</h2>
      <p><span>Lorem ipsum dolor sit amet,</span> consectetuer adipiscing elit. Donec mol bibendum nunc rte. Lorem ipsum dolor sit amet,consectetuer ewr adipiscing e. Integer porta enim vel mi.ertrerw Vivamus at mi. Ut porttitor tortor et risus.Sed ligula, sagittis quis,</p>
      <p class="more"><a href="http://web-mastery.info/">more</a></p>
      
    </div>
    <div id = 'login'>
		<?php
			if (isset($_COOKIE['id'])){
				echo $_COOKIE['access']." <a href= 'logout.php'>Выход</a>";
			}else
				echo "Здравствуй, гость"."<br><a href= 'in.php'>Войти</a><br><a href= 'reg.php'>Зарегистрироваться</a>"
		?>
		
      </div>
  </div>
</div>
<div id="bodyMainPan">
  <div id="bodyPan">
    <div id="bodyleftPan">
      <div id="linkPan">
        <h2>news links 2006</h2>
        <ul>
          <li><a href="http://web-mastery.info/">lorem ipsum dolor sit</a></li>
          <li><a href="http://web-mastery.info/">Amet, consectetuer</a> </li>
          <li><a href="http://web-mastery.info/">Adipiscing elit. Donec</a></li>
          <li><a href="http://web-mastery.info/">Bibendum nunc. Lorem</a></li>
          <li><a href="http://web-mastery.info/">Ipsum dolor sit amet,</a></li>
          <li><a href="http://web-mastery.info/">Consectetuer adipis</a></li>
          <li><a href="http://web-mastery.info/">Integer porta enim vel mi.</a></li>
          <li><a href="http://web-mastery.info/">Vivamus at mi.Ut</a></li>
        </ul>
        <p class="more"><a href="http://web-mastery.info/">more</a></p>
      </div>
      <div id="seminnerPan">
        <h2>seminer 2006</h2>
        <ul>
          <li><a href="http://web-mastery.info/">lorem ipsum dolor sit</a></li>
          <li><a href="http://web-mastery.info/">Amet, consectetuer</a> </li>
          <li><a href="http://web-mastery.info/">Adipiscing elit. Donec</a></li>
          <li><a href="http://web-mastery.info/">Bibendum nunc. Lorem</a></li>
          <li><a href="http://web-mastery.info/">Ipsum dolor sit amet,</a></li>
          <li><a href="http://web-mastery.info/">Consectetuer adipis</a></li>
          <li><a href="http://web-mastery.info/">Integer porta enim vel mi.</a></li>
          <li><a href="http://web-mastery.info/">Vivamus at mi.Ut</a></li>
        </ul>
        <p class="more"><a href="http://web-mastery.info/">more</a></p>
      </div>
      <h3>teachers</h3>
      <p class="one"><span>Lorem ipsum dolor sit amet,</span> consectetuer adipiscing elit. Donec mol ertwqr bibendum nunc rte. Lorem ipsum dolor sit amet,consectetuer ewr adipiscing e. Integer porta enim vel mi.ertrerw</p>
      <p class="more"><a href="http://web-mastery.info/">more</a></p>
      <p class="two"><span>Lorem ipsum dolor sit amet,</span> consectetuer adipiscing elit. Donec mol ertwqr bibendum nunc rte. Lorem ipsum dolor sit amet,consectetuer ewr adipiscing e. Integer porta enim vel mi.ertrerw</p>
      <p class="more"><a href="http://web-mastery.info/">more</a></p>
      <p class="three"><span>Lorem ipsum dolor sit amet,</span> consectetuer adipiscing elit. Donec mol ertwqr bibendum nunc rte. Lorem ipsum dolor sit amet,consectetuer ewr adipiscing e. Integer porta enim vel mi.ertrerw</p>
      <p class="more"><a href="http://web-mastery.info/">more</a></p>
    </div>
    <div id="bodyrightPan">
      <form action="http://web-mastery.info/" method="post">
        <h2>search</h2>
        <div id="formPan">
          <label>AUTHOR:</label>
          <select>
            <option>lorem ipsum</option>
          </select>
        </div>
        <div id="formPantwo">
          <label>CATAGORY:</label>
          <select>
            <option>lorem ipsum</option>
          </select>
        </div>
        <div id="formPanthree">
          <label>LANGUAGE:</label>
          <select>
            <option>lorem ipsum</option>
          </select>
        </div>
        <input name="" type="submit" value="search" />
      </form>
      <h3>sponsors links</h3>
      <ul>
        <li><a href="http://web-mastery.info/">lorem ipsum dolor sit</a></li>
        <li><a href="http://web-mastery.info/">Amet, consectetuer Adipiscing elit </a></li>
        <li><a href="http://web-mastery.info/">Donec Bibendum nunc. Lorem Ipsum</a></li>
        <li><a href="http://web-mastery.info/">dolor sit amet, Consectetuer adipis</a></li>
        <li><a href="http://web-mastery.info/">Integer porta</a></li>
      </ul>
      <h3>admission</h3>
      <ul>
        <li><a href="http://web-mastery.info/">lorem ipsum dolor sit</a></li>
        <li><a href="http://web-mastery.info/">Amet, consectetuer Adipiscing elit </a></li>
        <li><a href="http://web-mastery.info/">Donec Bibendum nunc. Lorem Ipsum</a></li>
        <li><a href="http://web-mastery.info/">dolor sit amet, Consectetuer adipis</a></li>
        <li><a href="http://web-mastery.info/">Integer porta</a></li>
      </ul>
    </div>
  </div>
</div>
<div id="footermainPan">
  <div id="footerPan">
    <ul>
      <li><a href="http://web-mastery.info/">main page</a>| </li>
      <li><a href="http://web-mastery.info/">about us</a>| </li>
      <li><a href="http://web-mastery.info/">main solutions</a>| </li>
      <li><a href="http://web-mastery.info/">books selling</a>| </li>
      <li><a href="http://web-mastery.info/">our support</a>| </li>
      <li><a href="http://web-mastery.info/">Contact</a></li>
    </ul>
    <p class="copyright">©guideline zone. all right reserved.</p>
    <ul class="templateworld">
      <li>design by:</li>
      <li><a href="http://www.templateworld.com" target="_blank">Template World</a></li>
    </ul>
    <div id="footerPanhtml"><a href="http://validator.w3.org/check?uri=referer" target="_blank">XHTML</a></div>
    <div id="footerPancss"><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">CSS</a></div>
  </div>
</div>
</body>
</html>
