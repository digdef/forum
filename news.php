<?php
require "system/source.php";
include "system/config.php";
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
	$news = new article('news');
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
		$coment = new comment();
		$coment->add_comment();
		?>			
		<div class="comment-group">
			<?php $coment->comments();?>
		</div>	
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>