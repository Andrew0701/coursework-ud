<?php
	setcookie('id',"", time() - 3600);
	setcookie('hash',"", time() - 3600);
	setcookie('access',"", time() - 3600);
	//print_r ($_COOKIE);
	header('Location: index.php');
?>
