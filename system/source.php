<?php

class News {

	public function news($table){

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
		$start = $page * $num - $num;

		$articles = mysqli_query($connection, "SELECT * FROM $table ORDER BY `id` DESC LIMIT $start, $num");
		if ($table == 'news') {
			while ($art = mysqli_fetch_assoc($articles))
			{
				echo'<article class="news"><div class="preview"><a style="padding-right: 20px;" href="">';
				echo'<img class="img" src="'. $art['img'].'"></a>';
				echo'<div><h2>'. $art['title'].'</h2>';
				echo $art['text'];
				echo'<br><button onclick="location=`news.php`" class="news-link">Подробнее</button>';
				echo'</div></div></article>';
			}			
		}
		if ($table == 'forum') {
			while ($art = mysqli_fetch_assoc($articles))
			{
				echo'<article class="news"><div class="preview">';
				echo'<div><h2>'. $art['title'].'</h2>';
				echo $art['text'];
				echo'<br><button onclick="location=`forum.php`" class="news-link">Подробнее</button>';
				echo'</div></div></article>';
			}	
		}
	}
}

class pagination {

	function pagination($table){

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