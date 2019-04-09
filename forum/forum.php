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
		<div class="toggle-btn" onclick="openMenu()">
			<span></span>
			<span></span>
			<span></span>
		</div>
		<h1 class="site-name"><a style="color: white" href="/">Forum</a></h1>
		<button onclick="location='/'" class="nav-btn">Блог</button>
		<button class="nav-btn">Категории</button>
		<button class="nav-btn">Аккаунт</button>
	</header>
	<div id="sidebar">
		<button onclick="location='/'" onclick="location='forum'" class="sidebar-btn">Блог</button>
		<button class="sidebar-btn">Категории</button>
		<button class="sidebar-btn">Аккаунт</button>
	</div>	
	<div style="padding-top: 60px;"></div>
	<h1 style="text-align: center; padding-bottom:10px; ">lorems</h1>
	<div class='news'>
		<div class="preview">
			<div>
				<h2>lorem</h2>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
	</div>
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
				<img id="avatar_img" src="../img/avatar.png"></p>
			</div>
			<div id="comment1">
				<span>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco<br>
				</span>
				<button class="news-link forum-link">Ответить</button>
			</div>
		</div>

		<div style="padding-left: 50px;" id="comment">
			<div>
				<div style="text-align: center;">
					<span>12qwe</span>
				</div>
				<img id="avatar_img" src="../img/avatar.png"></p>
			</div>
			<div id="comment1">
				<span>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco<br>
				</span>
				<button class="news-link forum-link">Ответить</button>
			</div>
		</div>

		<div style="padding-left: 100px;" id="comment">
			<div>
				<div style="text-align: center;">
					<span>12qwe</span>
				</div>
				<img id="avatar_img" src="../img/avatar.png"></p>
			</div>
			<div id="comment1">
				<span>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco<br>
				</span>
				<button class="news-link forum-link">Ответить</button>
			</div>
		</div>


		<div style="padding-left: 150px;" id="comment">
			<div>
				<div style="text-align: center;">
					<span>12qwe</span>
				</div>
				<img id="avatar_img" src="../img/avatar.png"></p>
			</div>
			<div id="comment1">
				<span>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco<br>
				</span>
				<button class="news-link forum-link">Ответить</button>
			</div>
		</div>

		<div id="comment">
			<div>
				<div style="text-align: center;">
					<span>123</span>
				</div>
				<img id="avatar_img" src="../img/avatar.png"></p>
			</div>
			<div id="comment1">
				<span>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco<br>
				</span>
				<button class="news-link forum-link">Ответить</button>
			</div>
		</div>
	</div>
	<script>
		function openMenu(){
			document.getElementById("sidebar").classList.toggle('active');
		}
	</script>
</body>
</html>