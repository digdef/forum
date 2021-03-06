<?php

class News {

	function __construct($table) {

		include "config.php";

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
		$text = mysqli_real_escape_string($connection,$art['text']);

		if ($table == 'news') {
			while ($art = mysqli_fetch_assoc($articles)) {
				include 'view/news/main-page-news.php';
			}
		}

		if ($table == 'forum') {
			while ($art = mysqli_fetch_assoc($articles)) {
				include '../view/forum/main-page-forum.php';
			}
		}
	}
}

class article {

	function __construct($table) {

		include "config.php";

		$article = mysqli_query($connection, "SELECT * FROM $table WHERE `id` = ".(int) $_GET['id']);

		if (mysqli_num_rows($article) <= 0) {
			include '404.php';
		} else {
			$art = mysqli_fetch_assoc($article);			
			if ($table == 'news') {
				include 'view/news/article.php';
			}

			if ($table == 'forum') {
				include '../view/forum/article.php';
			}

		}
	}
}

class pagination {

	function __construct($table) {

		include "config.php";

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

class comment {

	public function comments () {

		include "config.php";
		
		$article = mysqli_query($connection, "SELECT * FROM `news` WHERE `id` = ".(int) $_GET['id']);
		$art = mysqli_fetch_assoc($article);
		$comments = mysqli_query($connection, "SELECT * FROM `comment` WHERE `news_id` = '". (int) $art['id']."' ORDER BY `id` DESC");

		if (mysqli_num_rows($comments) <= 0) {
			include 'view/news/not-comments.php';
		}

		while ($comment = mysqli_fetch_assoc($comments)) {
			include 'view/news/comments.php';
		}
	}

	public function add_comment() {
		
		include "config.php";

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
				echo '<center><div id="reg_notifice" style="color: green; ">Успешно</div></center>';
			} else {
				echo '<center><span style="color: red;font-weight: bold; padding-bottom:30px;">'.$errors['0'].'</span></center>';
			}
		}
	}
}

class categories {

	function __construct($table) {

		include "config.php";

		$categories =mysqli_query($connection, "SELECT * FROM $table");
		while ($cat = mysqli_fetch_assoc($categories)){
			echo'<button onclick="location=`categories.php?id='.$cat['id'].'`" id="genre">'.$cat['categories'].'</button>';
		}
	}
}

class account {

	public function sign_in() {

		function generateSalt() {

			$salt = '';
			$saltLength = 8;
			for($i=0; $i<$saltLength; $i++) {
				$salt .= chr(mt_rand(33,126));
			}
			return $salt;
		}

		include "config.php";
		$data =$_POST;

		if (isset($data['do_login'])){
			if ( !empty($data['password']) and !empty($data['login']) ) {
				$login = $data['login'];
				$login = strip_tags($login);
				$login = mysqli_real_escape_string($connection, $login);
				$password = $data['password']; 
				$password = strip_tags($password);
				$password = mysqli_real_escape_string($connection, $password);	
				$query = 'SELECT*FROM users WHERE login="'.$login.'"';
				$result = mysqli_query($connection, $query); 
				$user = mysqli_fetch_assoc($result); 
				if (!empty($user)) {
					$saltedPassword =$user['password'];
					if (password_verify ($password ,$saltedPassword)) {
						session_start(); 
						$_SESSION['auth'] = true; 
						$_SESSION['id'] = $user['id']; 
						$_SESSION['login'] = $user['login'];
						if ( !empty($_REQUEST['remember']) and $_REQUEST['remember'] == 1 ) {
			
							$key = generateSalt(); 
							setcookie('login', $user['login'], time()+60*60*24*30); 
							setcookie('key', $key, time()+60*60*24*30); 
							$query = 'UPDATE users SET cookie="'.$key.'" WHERE login="'.$login.'"';
							mysqli_query($connection, $query);
						}
						header("location: index.php");
					}
					else {
						$errors[] = 'Введенный пароль неверен!';
					}
				} else {
					$errors[] = 'Такого пользователя не существует!';
				}

			}
		}
		if (!empty($errors)) {
			$GLOBALS['error'] = '<center><div id="reg_notifice" style="color: red;">'.array_shift($errors).'</div></center>';
		}


	}

	public function create_account() {

		include "config.php";
		
		$data =$_POST;
		$login = $data['login'];
		$login = strip_tags($login);
		$login = mysqli_real_escape_string($connection, $login);

		$email = $data['email'];
		$email = strip_tags($email);
		$email = mysqli_real_escape_string($connection, $email);

		$name = $data['name'];
		$name = strip_tags($name);
		$name = mysqli_real_escape_string($connection, $name);

		$password = $data['password'];
		$password = strip_tags($password);
		$password = mysqli_real_escape_string($connection, $password);

		$password_2 = $data['password_2'];
		$password_2 = strip_tags($password_2);
		$password_2 = mysqli_real_escape_string($connection, $password_2);

		$check_login = mysqli_query($connection,"SELECT * FROM `users` WHERE `login`='$login'");

		if (isset($data['do_signup'])) {
			$errors = array();
			if (trim($data['login']) == '') {
				$errors[] = 'Введите Логин!';
			}
			if (trim($data['email']) == '') {
				$errors[] = 'Введите Email!';
			}
			if (trim($data['name']) == '') {
				$errors[] = 'Введите Имя!';
			}
			if ($data['password'] == '') {
				$errors[] = 'Введите Пароль!';
			}
			if ($data['password_2'] != $data['password']) {
				$errors[] = 'Подтвердите Пароль!';
			}
			if (mysqli_num_rows($check_login) > 0) {
				$errors[] = 'Пользователь с таким логином уже существует!';
			}
			if (empty($errors)) {
				mysqli_query($connection, "INSERT INTO `users` (`login`,`email`,`name`,`password`) VALUES ('".$login."', '".$email."', '".$name."', '".password_hash($password, PASSWORD_DEFAULT)."')");
				echo '<center><div id="reg_notifice" style="color: green ;">успешно</div><hr></center>';
			}
			else {
				echo '<center><div id="reg_notifice" style="color: red;">'.array_shift($errors).'</div></center>';
			}
		}
	}
}

class login_check {

	function __construct() {

		include "config.php";
		
		if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
			if ( !empty($_COOKIE['login']) and !empty($_COOKIE['key']) ) {
				$login = $_COOKIE['login']; 
				$key = $_COOKIE['key'];
				$query = 'SELECT*FROM users WHERE login="'.$login.'" AND cookie="'.$key.'"';
				$result = mysqli_fetch_assoc(mysqli_query($connection, $query)); 
				if (!empty($result)) {
					session_start(); 
					$_SESSION['auth'] = true; 
					$_SESSION['id'] = $user['id']; 
					$_SESSION['login'] = $user['login']; 
				}
			}
		} else {
			header("location: account.php");
		}		
	}
}

class recovery {

	function __construct() {

		include "config.php";

		function generateSalt() {
			$salt = '';
			$saltLength = 8;
			for($i=0; $i<$saltLength; $i++) {
				$salt .= chr(mt_rand(33,126));
			}
			return $salt;
		}

		$mail = $_POST['email'];
		$user = mysqli_query($connection,"SELECT * FROM `users` WHERE `email`='".$mail."'");
		if (isset($_POST['recovery'])) {
			$errors = array();
			if (trim($_POST['email']) == '') {
				$errors[] = 'Введите Email!';
			}
			if (mysqli_num_rows($user) == 0) {
				$errors[] = 'Такого Email нет';
			}
			if (empty($errors)) {	
				mail("admin@forum.com", "Запрос на восстановление пароля", "Hello. ссылка на восстановление http://forum/account/password_recovery.php");
				session_start();
				$_SESSION['email'] = $mail;
			} else {
				echo '<center><span style="color: red;font-weight: bold; padding-bottom:30px;">'.$errors['0'].'</span></center>';
			}
		}
	}
}

class password_recovery {

	function __construct() {
		
		include "config.php";

		function generateSalt() {
			$salt = '';
			$saltLength = 8;
			for($i=0; $i<$saltLength; $i++) {
				$salt .= chr(mt_rand(33,126));
			}
			return $salt;
		}

		$id=$_SESSION['email'];
		$mail = $_SESSION['email'];
		$user = mysqli_query($connection,"SELECT * FROM `users` WHERE `email`='".$mail."'");
		$users = mysqli_fetch_array($user);
		if (isset($_POST['update_password'])) {
			$errors = array();
			if ($_POST['password'] == '') {
				$errors[] = 'Введите Пароль!';
			}
			if ($_POST['password_2'] != $_POST['password']) {
				$errors[] = 'Подтвердите Пароль!';
			}
			if (empty($errors)) {
				mysqli_query($connection, "UPDATE `users` SET `password` = '".password_hash($_POST['password'], PASSWORD_DEFAULT)."' WHERE `users`.`email` ='$mail' ");
				echo '<center><div id="reg_notifice" style="color: green ;">Успешно</div><hr></center>';
			} else {
				echo '<center><span style="color: red;font-weight: bold; padding-bottom:30px;">'.$errors['0'].'</span></center>';
			}
		}
	}
}

class search {

	function __construct($table) {

		include "config.php";

		if (isset($_POST['submit'])) {
			$reply = '';
			$search = $_POST['search'];
			$search = trim($search);
			$search = strip_tags($search);
			$search = mysqli_real_escape_string($connection, $search);
			
			if(!empty($search)){
				$result = mysqli_query($connection, "SELECT * FROM $table WHERE title LIKE '%$search%' ");
				$num = mysqli_num_rows($result);
				if ($table == 'news') {
					if($num > 0){
						$row = mysqli_fetch_assoc($result);  
						do{
							$reply .='<center><h2>Поиск по Блогу:</h2></center><br>';
							$reply .='<article class="news"><div class="preview"><a style="padding-right: 20px;" href="">';
							$reply .='<img class="img" src="'. $row['img'].'"></a>';
							$reply .='<div style="width: 100%"><h2>'. $row['title'].'</h2>';
							$reply .=mb_substr(strip_tags($row['text']), 0, 500, 'utf-8');
							$reply .='<br><button onclick="location=`news.php?id='.$row['id'].'`" class="news-link">Подробнее</button>';
							$reply .='</div></div></article>';
						}
						while($row = mysqli_fetch_assoc($result));
					} else{
						$reply = '<center><h2>По вашему запросу ничего не найдено.</h2></center><br>';
					}
				}
				if ($table == 'forum') {
					if($num > 0){
						$row = mysqli_fetch_assoc($result);  
						do{
							$reply .='<center><h2>Поиск по Форуму:</h2></center><br>';
							$reply .='<article class="news"><div class="preview">';
							$reply .='<div style="width: 100%"><h2>'. $row['title'].'</h2>';
							$reply .=mb_substr(strip_tags($row['text']), 0, 500, 'utf-8');
							$reply .='<br><button onclick="location=`forum.php?id='.$row['id'].'`" class="news-link">Подробнее</button>';
							$reply .='</div></div></article>';
						}
						while($row = mysqli_fetch_assoc($result));
					} else{
						$reply = '<center><h2>По вашему запросу ничего не найдено.</h2></center><br>';
					}
				}
			}
			else{
				$reply = '<center><h2>Задан пустой поисковый запрос.</h2></center><br>';
			}
			echo $reply;
		}
	}
}

class forum {

	public function add_discussion() {
		
		include "config.php";

		$article = mysqli_query($connection, "SELECT * FROM `forum` WHERE `id` = ".(int) $_GET['id']);
		$art = mysqli_fetch_assoc($article);
		$name = $_SESSION['login'];
		$res = mysqli_query($connection,"SELECT * FROM `users` WHERE `login`='$name' ");
		$user_data = mysqli_fetch_array($res);

		if (isset($_POST['add_comment'])) {
			$errors = array();
			if ($_POST['text'] == '') {
				$errors[] = 'Пусто';
			}
			if ($user_data['name'] == '') {
				$errors[] = 'Войдите';
			}
			if (empty($errors)) {
				$text = $_POST['text'];
				$text = strip_tags($text);
				$text = mysqli_real_escape_string($connection, $text);

				$answer_nick = $_POST['answer_nick'];
				$ans = mysqli_query($connection,"SELECT * FROM `users` WHERE `login`='$answer_nick' ");
				$answer_data = mysqli_fetch_array($ans);

				$answer_nick = strip_tags($answer_nick);
				$answer_nick = mysqli_real_escape_string($connection, $answer_nick);
				$answer = '<a href="../account/user.php?id='.$answer_data['id'].'">'.$answer_nick.', </a>';
				mysqli_query($connection, "INSERT INTO `discussion` (`text`,`nick`,`avatar`,`discussion_id`,`answer_nick`) VALUES ('".$text."', '".$user_data['name']."', '".$user_data['avatar']."', '".$art['id']."','".$answer."') ");
				echo '<center><div id="reg_notifice" style="color: green; ">Успешно</div></center>';
			} else {
				echo '<center><span style="color: red;font-weight: bold; padding-bottom:30px;">'.$errors['0'].'</span></center>';
			}
		}
	}

	public function discussion() {

		include "config.php";
		
		$article = mysqli_query($connection, "SELECT * FROM `forum` WHERE `id` = ".(int) $_GET['id']);
		$art = mysqli_fetch_assoc($article);
		$comments = mysqli_query($connection, "SELECT * FROM `discussion` WHERE `discussion_id` = '". (int) $art['id']."' ORDER BY `id` DESC");

		if (mysqli_num_rows($comments) <= 0) {
			include '../view/forum/not-discussion.php';
		}

		while ($comment = mysqli_fetch_assoc($comments)) {
			include '../view/forum/discussion.php';
		}
	}
}

class update_name {

	function __construct() {

		include "config.php";

		$name=$_SESSION['login'];
		$id=$_SESSION['id'];
		$res=mysqli_query($connection,"SELECT * FROM `users` WHERE `login`='$name' ");
		$user_data=mysqli_fetch_array($res);
		$data=$_POST;

		if (isset($data['update_name'])) {
			$errors = array();
			if ($data['name'] == '') {
				$errors[] = 'Введите Имя!';
			}
			if (empty($errors)) {
				mysqli_query($connection, "UPDATE `users` SET `name` = '".$data['name']."' WHERE `users`.`id` ='$id' ");
				echo '<center><span style="color: green ;">Успешно</span></center>';
			} else {
				echo '<center><span style="color: red;font-weight: bold; padding-bottom:30px;">'.$errors['0'].'</span></center>';
			}
		}
	}
}

class update_email {

	function __construct() {

		include "config.php";

		$name=$_SESSION['login'];
		$id=$_SESSION['id'];
		$res=mysqli_query($connection,"SELECT * FROM `users` WHERE `login`='$name' ");
		$user_data=mysqli_fetch_array($res);
		$data=$_POST;
	
		if (isset($data['update_email'])) {
			$errors = array();
			if ($data['email'] == '') {
				$errors[] = 'Введите Email!';
			}
			if (empty($errors)) {
				mysqli_query($connection, "UPDATE `users` SET `email` = '".$data['email']."' WHERE `users`.`id` ='$id' ");
				echo '<center><span style="color: green ;">Успешно</span></center>';
			} else {
				echo '<center><span style="color: red;font-weight: bold; padding-bottom:30px;">'.$errors['0'].'</span></center>';
			}
		}
	}
}

class update_password {

	function __construct() {

		include "config.php";

		$name=$_SESSION['login'];
		$id=$_SESSION['id'];
		$res=mysqli_query($connection,"SELECT * FROM `users` WHERE `login`='$name' ");
		$user_data=mysqli_fetch_array($res);
		$data=$_POST;
	
		if (isset($data['update_password'])) {
			$errors = array();
			if ($data['password'] == '') {
				$errors[] = 'Введите Пароль!';
			}
			if ($data['password_2'] != $data['password']) {
				$errors[] = 'Подтвердите Пароль!';
			}
			if (empty($errors)) {
				mysqli_query($connection, "UPDATE `users` SET `password` = '".password_hash($data['password'], PASSWORD_DEFAULT)."' WHERE `users`.`id` ='$id' ");
				echo '<center><span style="color: green ;">Успешно</span></center>';
			} else {
				echo '<center><span style="color: red;font-weight: bold; padding-bottom:30px;">'.$errors['0'].'</span></center>';
			}
		}
	}
}

class add_news {

	function __construct() {

		include "config.php";

		$name = $_SESSION['login'];

		if (isset($_POST['do_post'])) {
			$errors = array();
			if ($_POST['title'] == '') {
				$errors[] = 'Введите Название!';
			}
			if ($_POST['img'] == '') {
				$errors[] = 'Введите Имя Превью!';
			}
			if ($_POST['text'] == '') {
				$errors[] = 'Введите Текст!';
			}
			if ($_POST['categories'] == '') {
				$errors[] = 'выберите Категорию!';
			}			
			if (empty($errors)) {
				echo '<span style="color: green;font-weight: bold;">Успех</span><br>';
				mysqli_query($connection, "INSERT INTO `news` (`title`,`img`,`text`) VALUES ('".$_POST['title']."','".$_POST['img']."','".$_POST['text']."' )");
				mysqli_query($connection, "INSERT INTO `user_forum` (`title`,`name`) VALUES ('".$_POST['title']."','".$name."' )");
				mysqli_query($connection, "INSERT INTO `genre` (`categories`,`title`) VALUES ('".$_POST['categories']."','".$_POST['title']."' )");
			}
			else{
				echo '<span style="color: red;font-weight: bold;">'.$errors['0'].'</span>';
			}
		}
	}
}

class add_forum {

	function __construct() {

		include "config.php";

		$name = $_SESSION['login'];

		if (isset($_POST['do_post'])) {
			$errors = array();
			if ($_POST['title'] == '') {
				$errors[] = 'Введите Название!';
			}
			if ($_POST['text'] == '') {
				$errors[] = 'Введите Текст!';
			}
			if ($_POST['categories'] == '') {
				$errors[] = 'выберите Категорию!';
			}			
			if (empty($errors)) {
				echo '<span style="color: green;font-weight: bold;">Успех</span><br>';
				mysqli_query($connection, "INSERT INTO `forum` (`title`,`text`) VALUES ('".$_POST['title']."','".$_POST['text']."' )");
				mysqli_query($connection, "INSERT INTO `user_forum` (`title`,`name`) VALUES ('".$_POST['title']."','".$name."' )");
				mysqli_query($connection, "INSERT INTO `genre_forum` (`categories`,`title`) VALUES ('".$_POST['categories']."','".$_POST['title']."' )");
			}
			else{
				echo '<span style="color: red;font-weight: bold;">'.$errors['0'].'</span>';
			}
		}
	}
}

class page_categories {

	function __construct($table, $table2, $table3) {

		include "config.php";

		$categor = mysqli_query($connection, "SELECT * FROM $table2 WHERE `id` = ".(int) $_GET['id']);
		if (mysqli_num_rows($categor) <= 0) {
			include '404.php';
		} else {
			$res=mysqli_query($connection,"SELECT * FROM $table2 ");
			$user_data=mysqli_fetch_array($categor);
			$categories=$user_data['categories'];
			echo '<center><h1 style="text-align: center; padding-bottom: 10px; padding-top: 10px;">'.$categories.'</h1></center>' ;
			$subscriptions=mysqli_query($connection,"SELECT * FROM $table3 WHERE `categories`='$categories' ");

			if ($table == 'news') {
				while ($sub=mysqli_fetch_array($subscriptions)) { 
					$sub1=$sub['title'];
					$news = mysqli_query($connection, "SELECT * FROM $table WHERE `title`='$sub1' ORDER BY `id` DESC");
					$art = mysqli_fetch_assoc($news);
					include 'view/news/main-page-news.php';
				}
			}

			if ($table == 'forum') {
				while ($sub=mysqli_fetch_array($subscriptions)) { 
					$sub1=$sub['title'];
					$news = mysqli_query($connection, "SELECT * FROM $table WHERE `title`='$sub1' ORDER BY `id` DESC");
					$art = mysqli_fetch_assoc($news);
					include '../view/forum/main-page-forum.php';
				}
			}
		} 
	}
}

class add_categories {

	function __construct($table) {

		include "config.php";

		$categories =mysqli_query($connection, "SELECT * FROM $table");
		echo'<select class="box-login" name="categories">';
		while ($cat = mysqli_fetch_assoc($categories)){
			echo'<option>'.$cat['categories'].'</option>';
		}
		echo'</select>';
	}
}

class user_article {

	function __construct($table, $table2) {

		include "config.php";

		$users = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = ".(int) $_GET['id']);
		$user = mysqli_fetch_assoc($users);
		$name = $user['login'];
		$user=mysqli_query($connection,"SELECT * FROM $table WHERE `name`='$name' ");

		if (mysqli_num_rows($users) <= 0) {
			include '404.php';
		} else {
			if (mysqli_num_rows($user) <= 0) {
				echo '<div style="text-align: center;">';
				echo '<div>';
				echo '<h1>Тут Пусто!</h1>';
				echo '<img style="max-width: 40%; max-height: 40%;" src="../img/not.png">';
				echo '</div></div>';
			} else {
				while ($data_user=mysqli_fetch_array($user)) {

					$title=$data_user['title'];
					$article = mysqli_query($connection, "SELECT * FROM $table2 WHERE `title`='$title' ORDER BY `id`");
					$art = mysqli_fetch_assoc($article);

					if ($table2 == 'news') {
						include '../view/news/forum-page-news.php';
					}

					if ($table2 == 'forum') {
						include '../view/forum/forum-page-forum.php';
					}
				}
			}
		}
	}
}