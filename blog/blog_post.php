<!-- BEGIN blog_post -->
<section>
	<h2>Post header</h2>

<?php

@session_start();

include ('../common/sessions.php'); 

$sessions = new Sessions();
// $postBody = ''; 
$paras = array(); 

// unset all sessions if arriving to the post for the first time
if (!isset($_GET['from']) || (isset($_GET['from']) && $_GET['from'] != 'saved')) {
	$sessions -> unsetAll(); 
}

if (isset($numPosts)) {
	$postId = $postIdArray[$numPosts]; 
}

$numComments = $weblog->getNumComments($postId); 

?>

	<article>
		<header>
			<time datetime="<?php echo $dateFormatter->getNumericYear().'-'.$dateFormatter->getNumericMonth().'-'.$dateFormatter->getNumericDay(); ?>">
				<?php echo $dateFormatter->formatDate(); ?>
			</time>

<?php

	// title
	echo '<h2>'.html_entity_decode($postTitle).'</h2>'; 

?>

		</header>

<?php

	// body
	echo $body; 

?>

	</article>

	<article>
		<h2>Share this article</h2>

		<ul>
			<li>
			  <a href="https://twitter.com/share?text=<?php echo $postTitle; ?>&amp;url=<?php echo $SERVER_ROOT; ?>/blog/<?php echo $titleId; ?>/" target="_blank">Twitter</a>
			</li>

			<li>
			  <a href="https://www.facebook.com/sharer.php?u=<?php echo $SERVER_ROOT; ?>/blog/<?php echo $titleId; ?>/" target="_blank">Facebook</a>
			</li>
		</ul>
	</article>
</section>

<?php
/* }

/* do not display tags for the  moment
if (count($postIdArray) > 1) {

?>

	<ul class="tags">

<?php

	$i = 0; 

	foreach ($tags as $tagArray) {
		$i++; 

		if (count($tags) == $i) {
			$tagClass = 'last'; 
		} else {
			$tagClass = ''; 
		}

		echo 
			'<li class="'.$tagClass.'"><a href="blog?tagNameId='.$tagArray['tagNameId'].'">'.$tagArray['name'].'</a></li>'; 
	}
}

?>

	</ul>
*/

?>

<!-- END blog_post -->
