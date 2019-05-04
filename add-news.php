<?php 
require "system/source.php";
require "system/config.php";
session_start();
if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
	header("location: index.php");
} else {
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
	<?php
	include"view/news-header.php";
	$add_news = new add_news();
	?>
	<form method="POST" action="add-news.php">

		<label for="text">Название</label><br>
		<input type="text" placeholder="Введите Название" name="title" id="title"><br>
		<label >img(Название Превью)</label><br>
		<input type="text" name="img"><br>
		<label for="text">Текст</label><br>

		<textarea name="text" id="text"></textarea>
		<input type="submit" name="do_post" value="Отправить">
	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</body>
<script>
	CKEDITOR.replace( 'text' );
</script>
</html>
<?
}
?>