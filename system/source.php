<?php

class News {

	public function __construct($table) {

		include"config.php";

		$num = 5; 
		$page = 1;
		if ( isset($_GET['page']) ) {
			$page = (int) $_GET['page'];
		} 
		$result = mysqli_query($connection,"SELECT COUNT(`id`) AS `posts` FROM $table"); 
		$posts = mysqli_fetch_assoc($result);
		$posts = $posts['posts'];  
		$total = intval(($posts - 1) / $num) + 1;  
		$page = intval($page);  
		if(empty($page) or $page < 0) $page = 1;  
		  if($page > $total) $page = $total;  
		$start = $page * $num - $num;
		$articles = mysqli_query($connection, "SELECT * FROM $table ORDER BY `id` DESC LIMIT $start, $num");

		if ($table == 'news') {
			while ($art = mysqli_fetch_assoc($articles)) {
				echo'<article class="news"><div class="preview"><a style="padding-right: 20px;" href="">';
				echo'<img class="img" src="img/'. $art['img'].'"></a>';
				echo'<div><h2>'. $art['title'].'</h2>';
				echo $art['text'];
				echo'<br><button onclick="location=`news.php?id='.$art['id'].'`" class="news-link">Подробнее</button>';
				echo'</div></div></article>';
			}			
		}

		if ($table == 'forum') {
			while ($art = mysqli_fetch_assoc($articles)) {
				echo'<article class="news"><div class="preview">';
				echo'<div><h2>'. $art['title'].'</h2>';
				echo $art['text'];
				echo'<br><button onclick="location=`forum.php?id='.$art['id'].'`" class="news-link">Подробнее</button>';
				echo'</div></div></article>';
			}	
		}
	}
}

class article {

	public function __construct($table) {

		include"config.php";

		$article = mysqli_query($connection, "SELECT * FROM $table WHERE `id` = ".(int) $_GET['id']);

		if (mysqli_num_rows($article) <= 0) {
			echo '<div id="article-main">';
			echo '<div class="article-intro">';
			echo '<h2>Статья не найдена !!!</h2>';
			echo '<img style="max-width: 60%; max-height: 60%;" src="img/not.png">';
			echo '</div></div>';
		} else {
			$art = mysqli_fetch_assoc($article);
			echo'<article><div>';
			echo'<h1 style="text-align: center; padding-bottom: 10px; padding-top: 10px;">'.$art['title'].'</h1>';
			echo'<div class="news-img">';
			echo'<img src="img/'.$art['img'].'"></div>';
			echo'<div class="news-text"><span>';
			echo $art['text'];
			echo'</span></div></div></article>';
		}
	}
}

class pagination {

	public function __construct($table) {

		include"config.php";

		$num = 4; 
		$page = 1;
		if ( isset($_GET['page']) ) {
			$page = (int) $_GET['page'];
		} 
		$result = mysqli_query($connection,"SELECT COUNT(`id`) AS `posts` FROM $table"); 
		$posts = mysqli_fetch_assoc($result);
		$posts = $posts['posts'];  
		$total = intval(($posts - 1) / $num) + 1;  
		$page = intval($page);  
		if(empty($page) or $page < 0) $page = 1;  
		if($page > $total) $page = $total;  

		if ($page != 1) $pervpage = '<a style="font-size: 25px;color: #515966;" href= ./index.php?page=1><<</a>  
		                               <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page - 1) .'>&#9668;</a> ';
		if ($page != $total) $nextpage = ' <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page + 1) .'>&#9658;</a>  
		                                   <a style="font-size: 25px;color: #515966;" href= ./index.php?page=' .$total. '>>></a>';  
		if($page - 2 > 0) $page2left = ' <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page - 2) .'>'. ($page - 2) .'</a>  ';  
		if($page - 1 > 0) $page1left = '<a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page - 1) .'>'. ($page - 1) .'</a>  ';  
		if($page + 2 <= $total) $page2right = '  <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';  
		if($page + 1 <= $total) $page1right = '  <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
		echo $pervpage.$page2left.$page1left.'<b style="font-size: 26px;color: #515966;">'.$page.'</b>'.$page1right.$page2right.$nextpage;
	}
}

class coment {

	public function coments() {

		include"config.php";
		
		$article = mysqli_query($connection, "SELECT * FROM `news` WHERE `id` = ".(int) $_GET['id']);
		$art = mysqli_fetch_assoc($article);
		$comments = mysqli_query($connection, "SELECT * FROM `comment` WHERE `news_id` = '". (int) $art['id']."' ORDER BY `id` DESC");

		if (mysqli_num_rows($comments) <= 0) {
			echo'<div id="comment">';
			echo'<div style="text-align: center; width: 100%" id="comment1">';
			echo'<h3>Нет Комментариев!</h3></div></div>';
		}

		while ($comment = mysqli_fetch_assoc($comments)) {
			echo '<div id="comment"><div>';
			echo '<div style="text-align: center;">';
			echo '<span>'. $comment['nick'].'</span></div>';
			echo '<img id="avatar_img" src="img/'.$comment['avatar'].'"></p></div>';
			echo '<div id="comment1"><span>'.$comment['text'].'</span></div></div>';
		}
	}

	public function add_coment() {
		
		include"config.php";

		$article = mysqli_query($connection, "SELECT * FROM `news` WHERE `id` = ".(int) $_GET['id']);
		$art = mysqli_fetch_assoc($article);
		$name = $_SESSION['login'];
		$res = mysqli_query($connection,"SELECT * FROM `users` WHERE `login`='$name' ");
		$user_data = mysqli_fetch_array($res);

		if (isset($_POST['add_comment'])) {
			$errors = array();
			if ($_POST['text'] == '') {
				$errors[] = 'Добавьте Комментарий';
			}
			if ($user_data['name'] == '') {
				$errors[] = 'Войдите';
			}
			if (empty($errors)) {
				$text = $_POST['text'];
				$text = strip_tags($text);
				$text = mysqli_real_escape_string($connection, $text);
				mysqli_query($connection, "INSERT INTO `comment` (`text`,`nick`,`avatar`,`news_id`) VALUES ('".$text."', '".$user_data['name']."', '".$user_data['avatar']."', '".$art['id']."') ");
				echo '<div id="reg_notifice" style="color: green; ">Успешно</div>';
			} else {
				echo '<center><span style="color: red;font-weight: bold; padding-bottom:30px;">'.$errors['0'].'</span></center>';
			}
		}
	}
}

class categories {

	public function __construct() {

		include"config.php";

		$categories =mysqli_query($connection, "SELECT * FROM `categories`");
		while ($cat = mysqli_fetch_assoc($categories)){
			echo'<button onclick="location=`/categories.php?id='.$cat['id'].'`" id="genre">'.$cat['categories'].'</button>';
		}
	}
}