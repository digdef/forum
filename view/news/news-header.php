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
		<form class="search-box " name="search" method="post" action="search.php">
			<input class="search-txt" type="search" name="search" placeholder="Type ro search">
			<button name="submit" type="submit" class="search-btn btn btn-link">
				<i class="fas fa-search"></i>
			</button> 
		</form>
	</div>
	<div id="sidebar">
		<button onclick="location='forum'" onclick="location='forum'" class="sidebar-btn">Форум</button>
		<button class="sidebar-btn" onclick="toggle('#vipad');">Категории</button>
		<button class="sidebar-btn" onclick="location='account'">Аккаунт</button>
	</div>
	<div id="vipad">
		<div id="genre-bar">
			<?php $categories = new categories('categories');?>
		</div>
	</div>
</header>

<div style="padding-top: 50px;"></div>