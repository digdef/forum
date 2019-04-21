<?php
require "system/source.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
			<button onclick="location='forum'" class="nav-btn">Форум</button>
			<button class="nav-btn" onclick="toggle('#vipad');">Категории</button>
			<button class="nav-btn" onclick="location='account'">Аккаунт</button>
			<form class="search-box" name="search" method="post">
				<input class="search-txt" type="search" name="search" placeholder="Type ro search">
				<button name="submit" type="submit" class="search-btn btn btn-link">
					<i class="fas fa-search"></i>
				</button> 
			</form>
		</div>
	</header>
	<div id="sidebar">
		<form class="sidebar-search-box" name="search" method="post">
			<input class="search-txt" type="search" name="search" placeholder="Type ro search">
			<button name="submit" type="submit" class="search-btn btn btn-link">
				<i class="fas fa-search"></i>
			</button>
		</form>
		<button onclick="location='forum'" onclick="location='forum'" class="sidebar-btn">Форум</button>
		<button class="sidebar-btn" onclick="toggle('#vipad');">Категории</button>
		<button class="sidebar-btn" onclick="location='account'">Аккаунт</button>
	</div>
	<div style="padding-top: 50px;"></div>
	<div id="vipad">
		<div id="genre-bar">
			<button onclick="location=''" id="genre">Еда</button>
			<button onclick="location=''" id="genre">Люди</button>
			<button onclick="location=''" id="genre">IT</button>
			<button onclick="location=''" id="genre">Другое</button>
		</div>
	</div>
	<h1 style="text-align: center; padding-bottom: 10px; padding-top: 10px;">Новости</h1>
	<?php $news = new News();?>
	<div style="text-align: center;">
		<?php $pagination = new pagination();?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>