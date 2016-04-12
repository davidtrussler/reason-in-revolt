<?php session_start();

include ('../common/doctype.php'); 
include ('../common/variables.php'); 
include ('../common/dateFormatter.php'); 

if (isset($_GET['postId'])) {
	$page_class = 'blog-post'; 
} else {
	$page_class = 'blog-main'; 
}

$title = 'blog';

include ('../common/environment.php'); 
include ('../common/weblog.php'); 

?>

<html>

<?php

include ('../common/head.php');

?>

	<body class="<?php echo $page_class; ?>">

<?php

include ('../common/header.php');

$weblog = new Weblog($DOC_ROOT);

// TODO - get blog posts as object not 2 db requests
// and get post from titleid not postid
if (isset($_GET['tagNameId'])) {
	$postIdArray = $weblog->getPostIds($_GET['tagNameId'], ''); 
} elseif (isset($_GET['month'])) {
	$postIdArray = $weblog->getPostIds('', $_GET['month']); 
} else {
	$posts = $weblog->getPosts(); 
}

if (!isset($_GET['postId'])) {
	include ('blog_intro.php'); 
}

include ('blog_primary.php'); 

if (isset($_GET['postId'])) {
	include ($DOC_ROOT.'/blog/blog_secondary.php'); 
}

include ('../common/footer.php');

?>

	</body>
</html>