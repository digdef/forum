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
	<header class="header">
		<div class="toggle-btn" onclick="openMenu()">
			<span></span>
			<span></span>
			<span></span>
		</div>
		<h1 class="site-name"><a style="color: white" href="/">Forum</a></h1>
		<button onclick="location='/'" class="nav-btn">Блог</button>
		<button onclick="location='../forum'" class="nav-btn">Форум</button>
		<button class="nav-btn">Выйти</button>\
		<form class="search-box " name="search" method="post">
			<input class="search-txt" type="search" name="search" placeholder="Type ro search">
			<button name="submit" type="submit" class="search-btn btn btn-link">
				<i class="fas fa-search"></i>
			</button> 
		</form>	
	</header>
	<div id="sidebar">
		<button onclick="location='/'" class="sidebar-btn">Блог</button>
		<button onclick="location='../forum'" class="sidebar-btn">Форум</button>
		<button class="sidebar-btn">Выйти</button>
	</div>
	<div style="padding-top: 50px;"></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/main.js"></script>
</body>
</html>