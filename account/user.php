<?php 
require "../system/source.php";
require "../system/config.php";
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
	<div style="padding-top: 50px;"></div>
	<?php
	$users = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = ".(int) $_GET['id']);
	$user = mysqli_fetch_assoc($users);
	?>
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
						echo $user['name']."<br>";
						echo "Почта: ". $user['email']."<br>";
						$data =$_POST;
						?>
					</span></p>
				</center>
			</div>
		</article>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/main.js"></script>
</body>
</html>