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
			<?php $categories = new categories();?>
		</div>
	</div>
	<?php 
	$news = new article('news');
	include"system/config.php";
	$article = mysqli_query($connection, "SELECT * FROM `news` WHERE `id` = ".(int) $_GET['id']);
	$art = mysqli_fetch_assoc($article);
	?>
	<div>
		<div class="box-comment">
			<form action="news.php?id=<? echo $art['id'];?>" method="POST">
				<input type="text" name="text" placeholder="Комментарий">
				<button type="submit" name="add_comment"><i class="far fa-paper-plane"></i></button>
			</form>
		</div>
		<?php 
		$coment = new coment();
		$coment->add_coment();
		?>			
		<div class="comment-group">
			<?php $coment->coments();?>
		</div>	
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>