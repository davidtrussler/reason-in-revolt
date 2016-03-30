<?php

// set the timezone for date-based calculations
date_default_timezone_set('Europe/London'); 

/*
 * will need to restore this in future
 * for now have hard-coded the server-root value
if ($_SERVER['SERVER_NAME'] == 'davidtrussler.net') {
	$SERVER_ROOT = 'http://davidtrussler.net/'; 
	$DOC_ROOT = '/home/futuragr/public_html/davidtrussler/'; 
} else {
	$SERVER_ROOT = 'http://localhost/dtNet/';
	$DOC_ROOT = '/Library/WebServer/Documents/dtNet/';
}
*/

$DOC_ROOT = '/Library/WebServer/Documents/reason-in-revolt/';
$SERVER_ROOT = 'http://localhost/reason-in-revolt/';

/* 
 * also will need to be worked on in future - updated to include moderation
$COMMENT_EXPIRE = 243; // number of days until comments are disabled
*/

?>