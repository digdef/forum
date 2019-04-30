<?php
session_start();
require "../system/source.php";
$check= new login_check();
$account = new account();
$account->sign_in();
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
	<div style="padding-top: 50px;"></div>
	<?
	echo $error;
	?>
	<center>
		<div>
			<form action="index.php" method="POST"> 
				<h1>Вход</h1>
				<input class="box-login" required="" type="text" name="login" placeholder="Логин"><br>
				<input class="box-login" required="" type="password" name="password" placeholder="Пароль">
				<div>
					Запомнить <input name='remember' type='checkbox' value='1'>
				</div>
				<input class="button-login" type="submit" name="do_login" value="Вход">
			</form>
			<a id="link1" href="recovery.php">Забыл пароль!</a>
	
			<form class="log-box" action="index.php" method="POST">
				<h1>Регистрация</h1>
				<?php
					$account->create_account();
				?>	
				<input class="box-login" required="Введите Логин" type="text" name="login" placeholder="Ваш Логин" value="<? echo @$data['login'] ?>">
				<input class="box-login" required="Введите Имя" type="text" name="name" placeholder="Ваше Имя" value="<? echo @$data['name'] ?>">
				<input class="box-login" required="Введите Email" type="email" name="email" placeholder="Ваш Email" value="<? echo @$data['email'] ?>">  
				<input class="box-login" minlength="7" required="Введите Пароль" type="password" name="password" placeholder="Пароль" value="<? echo @$data['password'] ?>">
				<input class="box-login" minlength="7" required="Подтвердите Пароль" type="password" name="password_2" placeholder="Подтвердите Пароль" value="<? echo @$data['password_2'] ?>">
				<input class="button-login" type="submit" name="do_signup" value="Регистрация">
			</form>
		</div>		
	</center>

</body>
</html>