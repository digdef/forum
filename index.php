<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>forum</title>
</head>
<body>
	<header class="header">
		<div class="toggle-btn" onclick="openMenu()">
			<span></span>
			<span></span>
			<span></span>
		</div>
		<h1 class="site-name"><a style="color: white" href="/">Forum</a></h1>
		<button onclick="location='forum'" class="nav-btn">Форум</button>
		<button class="nav-btn" onclick="toggle('#vipad');">Категории</button>
		<button class="nav-btn">Аккаунт</button>
	</header>
	<div id="sidebar">
		<button onclick="location='/'" onclick="location='forum'" class="sidebar-btn">Блог</button>
		<button class="sidebar-btn">Категории</button>
		<button class="sidebar-btn">Аккаунт</button>
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
	<article class='news'>
		<div class="preview">
			<a style="padding-right: 20px;" href="">
				<img class="img" src="img/1.jpg">
			</a>
			<div>
				<h2>lorem</h2>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br>
				<button onclick="location='news.php'" class="news-link">Подробнее</button>
			</div>
		</div>
	</article>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>