<!-- BEGIN blog_secondary -->
<div>
	<h3>Recent posts</h3>

<?php

/* 
 * this is a mess!
 * get all posts as object again 
 * take out multiple db queries!
 */
for ($i = 0; $i < count($posts); $i++) {
	// $thisPostId = $postIdArray[$i]; 

	// $post = $weblog->getPost($thisPostId);
	$post = $posts[$i]; 

	$thisPostId = $post[0]; 
	$titleId = $post[1]; 
	$date = $post[2]; 
		$date = $dateFormatter->formatDate($date); 
	// $title = $post[3]; 
	$title = htmlspecialchars_decode($post[3], ENT_QUOTES);

?>

	<div>
		<p><?php echo $date ?></p>

<?php

		// if ($postId == $postIdArray[$i]) {
		if ($postId == $thisPostId) {

?>

		<p><?php echo $title ?></p>

<?php

	} else {

?>

		<p>
			<a href="<?php echo $SERVER_ROOT.'/blog/'.$titleId.'/'; ?>">
				<?php echo $title; ?>
			</a>
		</p>

<?php

	}

?>

	</div>

<?php

}

?>

</div>
<!-- END blog_secondary -->