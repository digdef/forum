<?php 
require "../system/source.php";
require "../system/config.php";
session_start();
if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
	header("location: index.php");
} else {
	$name=$_SESSION['login'];
	$id=$_SESSION['id'];
	$res=mysqli_query($connection,"SELECT * FROM `users` WHERE `login`='$name' ");
	$user_data=mysqli_fetch_array($res);
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
		<div class="header">
			<div class="toggle-btn" onclick="openMenu()">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<h1 class="site-name"><a style="color: white" href="/">Forum</a></h1>
			<button onclick="location='/'" class="nav-btn">Блог</button>
			<button onclick="location='../forum'" class="nav-btn">Форум</button>
			<button onclick="location='exit.php'" class="nav-btn">Выйти</button>
			<form class="search-box " name="search" method="post">
				<input class="search-txt" type="search" name="search" placeholder="Type ro search">
				<button name="submit" type="submit" class="search-btn btn btn-link">
					<i class="fas fa-search"></i>
				</button> 
			</form>
		</div>
	</header>
	<div id="sidebar">
		<button onclick="location='/'" class="sidebar-btn">Блог</button>
		<button onclick="location='../forum'" class="sidebar-btn">Форум</button>
		<button class="sidebar-btn">Выйти</button>
	</div>
	<div style="padding-top: 70px;"></div>

	<div id="main">
		<article style="display: inline-block;">
			<div class="avatar" style="text-align: center;">
				<img style="min-width: 210" id="index_img"  src="../img/<? echo $user_data['avatar'];?>"></p>
				<button onclick="location='../forum/add-forum.php'" class="button-login" style="width: 250px;">Добавить Обсуждение</button><br>
				<button onclick="location='../add-news.php'" class="button-login" style="width: 250px;">Добавить Новость</button>
			</div>

			<div class="text">
				<center>
					<span id="name">
						<?
						echo $user_data['name']."<br>";
						echo "Почта: ". $user_data['email']."<br>";
						$data =$_POST;
						?>
					</span></p>
					<form action="account.php" method="POST">
						<h2>Настройки</h2>
						<input class="box-login" type="text" name="name" placeholder="Изменить Имя" value="<? echo @$data['name'] ?>"><br>
						<input class="button-login" type="submit" name="update_name" value="Изменить"><br>
						<?
							$update_name = new update_name();
						?>
						<input class="box-login" type="email" name="email" placeholder="Изменить Email" value="<? echo @$data['email'] ?>"><br>
						<input class="button-login" id="btn" type="submit" name="update_email" value="Изменить"><br>
						<?
							$update_email = new update_email();
						?>
						<input class="box-login" minlength="7" type="password" name="password" placeholder="Изменить Пароль" value="<? echo @$data['password'] ?>">
						<input class="box-login" minlength="7" type="password" name="password_2" placeholder="Подтвердите Пароль" value="<? echo @$data['password_2'] ?>"><br>
						<input class="button-login" id="btn"  type="submit" name="update_password" value="Изменить">
						<?
							$update_password = new update_password();
						?>
					</form>
				</center>
			</div>
		</article>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/main.js"></script>
</body>
</html>
<?
}
?>