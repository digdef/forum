<?php
session_start();
require "../system/source.php";
include "../system/config.php";
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
	<?php include"../view/forum-header.php";
	$discussion = new forum();
	$article = new article('forum');
	$article = mysqli_query($connection, "SELECT * FROM `forum` WHERE `id` = ".(int) $_GET['id']);
	$art = mysqli_fetch_assoc($article);
	?>
	<div class="box-comment container" >
		<form action="forum.php?id=<? echo $art['id'];?>" method="POST">
			<input style="display: none; width: 10%; float: left;" class="container" id="answer_nick" type="text" name="answer_nick" placeholder="Ответить Кому?">
			<input id="text" type="text" name="text" placeholder="Введите текст">
			<button type="submit" name="add_comment"><i class="far fa-paper-plane"></i></button>
		</form>
	</div>
	<?php 
	$discussion->add_discussion();
	?>
	<div class="comment-group">
		<?php $discussion->discussion();?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/main.js"></script>
	<script>
		function answer (name) {
			var txt = name ;
			var langg = document.getElementById ('answer_nick'); 
			var nc = langg.selectionStart; 
			langg.value = langg.value.substr (0, nc) + txt + langg.value.substr (nc);
			langg.style.display = (langg.style.display == 'none') ? '' : 'none';
		}
	</script>
</body>
</html>