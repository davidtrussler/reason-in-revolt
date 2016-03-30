<?php session_start();

include ('../common/doctype.php'); 
include ('../common/variables.php'); 
include ('../common/dateFormatter.php'); 

/*
if (isset($_GET['postId'])) {
	$primaryClass = 'blogPost'; 
} else {
	$primaryClass = 'blogMain'; 
}
*/

$title = 'blog';

include ('../common/environment.php'); 
include ('../common/weblog.php'); 

?>

<html>

<?php

include ('../common/head.php');

?>

	<body>
		<div>

<?php

include ('../common/header.php');

?>

<?php

$weblog = new Weblog($DOC_ROOT);
$dateFormatter = new DateFormatter();

// TODO - get blog posts as object not 2 db requests
// and get post from titleid not postid
if (isset($_GET['tagNameId'])) {
	$postIdArray = $weblog->getPostIds($_GET['tagNameId'], ''); 
} elseif (isset($_GET['month'])) {
	$postIdArray = $weblog->getPostIds('', $_GET['month']); 
} else {
	$posts = $weblog->getPosts(); 
}

?>

			<!-- BEGIN main -->
			<div>

<?php

if (!isset($_GET['postId'])) {
	include ('blog_intro.php'); 
}

include ('blog_primary.php'); 

if (isset($_GET['postId'])) {
	include ($DOC_ROOT.'/blog/blog_secondary.php'); 
}

?>

			</div>
			<!-- END main -->

<?php

include ('../common/footer.php');

?>

		</div>
	</body>
</html>