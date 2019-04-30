<?php
require "../system/source.php";
session_start();
$recovery = new password_recovery();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>	
	<title>forum</title>
</head>
<body>
	<header>
			<h1 style="text-align: center; padding: 0; margin: 0;" class="site-name"><a style="color: white" href="/">Forum</a></h1>
	</header>
	<div style="padding-top: 60px;"></div>
	<center>
		<div>
			<form action="recovery.php" method="POST"> 
				<h1>Забыл пароль!</h1><br>
				<input class="box-login"  minlength="7" type="password" name="password" placeholder="Изменить Пароль" value="<? echo @$_POST['password'] ?>"><br>
				<input class="box-login"  minlength="7" type="password" name="password_2" placeholder="Подтвердите Пароль" value="<? echo @$_POST['password_2'] ?>"><br>
				<input class="button-login" type="submit" name="update_password" value="Отправить">
			</form>
		</div>
	</center>
</body>
</html>