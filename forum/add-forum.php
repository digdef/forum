<?php 
require "../system/source.php";
require "../system/config.php";
session_start();
if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
	header("location: index.php");
} else {
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
			<button class="nav-btn" onclick="location='../account'">Аккаунт</button>
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
		<button class="sidebar-btn" onclick="location='../account'">Аккаунт</button>
	</div>
	<div style="padding-top: 50px;"></div>
	<form style="text-align: center;" method="POST" action="add-forum.php">
		<?php $add_forum = new add_forum();?><br>
		<label style="font-size: 25px;" for="text">Название</label><br>
		<input class="box-login" type="text" placeholder="Введите Название" name="title" id="title"><br>
		<label style="font-size: 25px;">Категория</label><br>
		<?php $add_categories = new add_categories('categories_forum');?><br>
		<label style="font-size: 25px;" for="text">Текст</label><br>

		<textarea name="text" id="text"></textarea>
		<input class="button-login" type="submit" name="do_post" value="Отправить">
	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/main.js"></script>
	<script type="text/javascript" src="../lib/ckeditor/ckeditor.js"></script>
</body>
<script>
	CKEDITOR.replace( 'text' );
</script>
</html>
<?
}
?>