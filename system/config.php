<?php
$config = array(
	'title'=>'chlen 50 sm',
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
