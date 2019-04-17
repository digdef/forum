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
			<form class="search-box " name="search" method="post">
				<input class="search-txt" type="search" name="search" placeholder="Type ro search">
				<button name="submit" type="submit" class="search-btn btn btn-link">
					<i class="fas fa-search"></i>
				</button> 
			</form>
		</div>
	</header>
	<div id="sidebar">
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
	<article>
		<div>
			<h1 style="text-align: center; padding-bottom: 10px; padding-top: 10px;">lorem</h1>
			<div class="news-img">
				<img src="img/1.jpg">
			</div>
			<div class="news-text">
				<span>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</span>				
			</div>
		</div>
	</article>
	<div>
		<div class="box-comment">
			<form action="film.php?id=<? echo $art['id'];?>" method="POST">
				<input type="text" name="text" placeholder="Комментарий">
				<button type="submit" name="add_comment"><i class="far fa-paper-plane"></i></button>
			</form>
		</div>
		<div class="comment-group">
			<div id="comment">
				<div>
					<div style="text-align: center;">
						<span>123</span>
					</div>
					<img id="avatar_img" src="img/avatar.png"></p>
				</div>
				<div id="comment1">
					<span>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco
					</span>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>