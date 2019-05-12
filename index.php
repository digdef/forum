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
	<?php include"view/news/news-header.php";?>
	<h1 style="text-align: center; padding-bottom: 10px; padding-top: 10px;">Новости</h1>
	<?php $news = new News('news');?>
	<div style="text-align: center;">
		<?php $pagination = new pagination('news');?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>