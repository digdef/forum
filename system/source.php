<?php

class News{
	function __construct(){
		$config = array(
			'bd'=>array(
				'server'=>'localhost',
				'username'=>'root',
				'password'=>'',
				'name'=>'forum'
			)
		);

		$connection = mysqli_connect(
			$config['bd']['server'],
			$config['bd']['username'],
			$config['bd']['password'],
			$config['bd']['name']
		);
		$news = mysqli_query($connection, "SELECT * FROM `news` ORDER BY `id`");
		$mov = mysqli_fetch_assoc($news);
	}

	public $id='text';
	public $title='text';
	public $img='img/1.jpg';
	public $text='Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
}

$news = new News();