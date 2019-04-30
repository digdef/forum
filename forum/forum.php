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
	$article = mysqli_query($connection, "SELECT * FROM `forum` WHERE `id` = ".(int) $_GET['id']);
	$art = mysqli_fetch_assoc($article);
	?>
	<h1 style="text-align: center; padding-bottom: 10px; padding-top: 10px;">lorems</h1>
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
		<form action="forum.php?id=<? echo $art['id'];?>" method="POST">
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
			var langg = document.getElementById ('text'); 
			var nc = langg.selectionStart; 
			langg.value = langg.value.substr (0, nc) + txt + langg.value.substr (nc);
		}
	</script>
</body>
</html>