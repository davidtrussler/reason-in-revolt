<?php

$title = 'blog'; 

include ('../common/weblog.php'); 
include ('common/adminHeader.php'); 

$weblog = new Weblog($DOC_ROOT);

?>

<h3>Posts</h3>

<?php

if (isset($_POST['action'])) {
	$article = new DOMDocument("1.0");
	$root = $article->createElement("article");
	$article->appendChild($root);

	$title = $_POST['title']; 
		// $title = addslashes($title); 
		$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8', false); 
	$newTags = $_POST['newTags']; 
	$body = $_POST['body']; 

	/* format body for database storage -- */
	while (stripos($body, "\r") !== false) {
		$body = str_replace("\r", "\n", $body); 
	}

	$body = str_replace("</p>", "</p>\n", $body); 

	// strip tags
	$body = strip_tags($body, '<h1><h2><h3><h4><h5><ol><ul><li><a><span>'); 

	while (stripos($body, "\n\n") !== false) {
		$body = str_replace("\n\n", "\n", $body); 
	}

	// echo '<br /><br />body = '.$body; 

	$paras = explode("\n", $body); 

	// echo '<br /><br />paras = '; print_r($paras); 

	$bodySave = ''; 

	for($i = 0; $i < count($paras); $i++) {
		// create child element
		$para = $article->createElement("para");
		$root->appendChild($para);

		// $para->appendChild($paras[$i]);
		// $bodySave .= $article->saveXML($paras[$i]); 

		// create cdata section
		$cdata = $article->createCDATASection($paras[$i]);
		$para->appendChild($cdata);
	}

	// echo '<br /><br />article = '; print_r($article); 

	$bodySave = $article->saveXML();

	// echo '<br /><br />bodySave = '.$bodySave;

	// $body = addslashes($body); 
	$bodySave = htmlspecialchars($bodySave, ENT_QUOTES, 'UTF-8', false); 

	// echo '<br /><br />bodySave = '.$bodySave;
	/* -- format body for database storage */

	if (isset($_POST['postId'])) {
		$postId = $_POST['postId']; 
	} else {
		$postId = ''; 
	}

	if (isset($_POST['tag'])) {
		$tagArray = array_keys($_POST['tag']); 
	} else {
		$tagArray = array(); 
	}

	$postSaved = $weblog->savePost($postId, $title, $bodySave, $tagArray, $newTags); 
	// echo 'postSaved: '.$postSaved; 
}

echo '<ul>'; 

$postIdArray = $weblog->getPostIds('', ''); 

foreach ($postIdArray as $postId) {
	$post = $weblog->getPost($postId); 
	$title = html_entity_decode($post['title']); 

?>

	<li>
		<?php echo $title; ?>

		<form action="edit.php" method="post">
			<input type="hidden" name="postId" value="<?php echo $postId; ?>"/>

			<button type="submit">Edit</button>
		</form>
	</li>

<?php

	}

echo '</ul>'; 

?>

<form action="edit.php" method="post">
	<button type="submit">Add new post</button>
</form>

<?php

include('common/adminFooter.php'); 

?>