<!-- BEGIN blog_secondary -->
<section class="blog-post__secondary">
	<h2>Recent posts</h2>

<?php

/* 
 * this is a mess!
 * get all posts as object again 
 * take out multiple db queries!
 */
for ($i = 0; $i < count($posts); $i++) {
	$dateFormatter = new DateFormatter($post[2]);
	$date = $dateFormatter->formatDate(); 
	$post = $posts[$i]; 
	$thisPostId = $post[0]; 
	$titleId = $post[1]; 
	$title = htmlspecialchars_decode($post[3], ENT_QUOTES);

?>

	<article>
		<time datetime=""><?php echo $date ?></time>

<?php

		if ($postId == $thisPostId) {

?>

		<h3><?php echo $title ?></h3>

<?php

	} else {

?>

		<h3>
			<a href="<?php echo $SERVER_ROOT.'/blog/'.$titleId.'/'; ?>">
				<?php echo $title; ?>
			</a>
		</h3>

<?php

	}

?>

	</article>

<?php

}

?>

</section>
<!-- END blog_secondary -->