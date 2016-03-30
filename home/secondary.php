<!-- BEGIN secondary -->
<div>
	<h2>Latest Blog Posts</h2>

	<ul>

<?php

for ($i = 0; $i < count($postIdArray); $i++) {
$thisPostId = $postIdArray[$i]; 
$post = $weblog->getPost($thisPostId);
$title = html_entity_decode($post['title']); 
$titleId = $post['titleId']; 

?>

	<li><a href="<?php echo $SERVER_ROOT.'blog/'.$titleId.'/'; ?>"><?php echo $title ?></a></li>

<?php

}

?>
	</ul>
</div>
<!-- END secondary -->
