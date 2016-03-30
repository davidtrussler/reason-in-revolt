<?php

$self = $_SERVER['PHP_SELF']; 
$selfArray = explode('/', $self); 
// $page = array_pop($selfArray); 
$root = join('/', $selfArray).'/'; 
// $pageArray = explode('.', $page); 

$link_array = array (
	'home' => 'home', 
	'blog' => 'blog'
); 

?>