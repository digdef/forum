<?php

class connectBD{
	private $link;

	public function __construct(){
		$this->connect();
	}

	private function connect(){
		$config = require_once "config.php";

		$dsn='mysql:host=localhost;dbname=forum;charset=utf8';

		$this->link = new PDO($dsn,'root','');

		return $this;
	}

	public function execute($sql){
		$sth = $this->link->prepare($sql);

		return $sth->execute();
	}

	public function query($sql){
		$sth = $this->link->prepare($sql);

		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		if ($result === false) {
			return $result;
		}

		return $result;
	}
}

class News{

	public function news(){
		$connect=new connectBD();
		foreach($connect->query('SELECT * FROM news ORDER BY `id`') as $row) { 
			echo'<article class="news"><div class="preview"><a style="padding-right: 20px;" href="">';
			echo'<img class="img" src="'. $row['img'].'"></a>';
			echo'<div><h2>'. $row['title'].'</h2>';
			echo $row['text'];
			echo'<br><button onclick="location=`news.php`" class="news-link">Подробнее</button>';
			echo'</div></div></article>';
		}
	}
}
