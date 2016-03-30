<?php

$title = 'edit'; 

include ('../common/environment.php'); 
include ('../common/weblog.php'); 
include ('common/adminHeader.php'); 

$weblog = new Weblog($DOC_ROOT);
$allTags = $weblog->getTags(); 
$tagIdArray = array(); 

if (isset($_POST['postId'])) {
	$postId = $_POST['postId']; 
	$paras = array(); 
	$bodyEdit = ''; 
	$post = $weblog->getPost($postId); 
	$body = $post['body'];
		// $body = stripslashes($body);
		$body = htmlspecialchars_decode($body, ENT_QUOTES);
	$title = $post['title'];
		// $title = stripslashes($title);
		$title = htmlspecialchars_decode($title, ENT_QUOTES);
	$tags = $post['tags']; 

	$bodyXml = new DOMDocument();
	$bodyXml->loadXML($body);
	// $bodyXml->loadXML($post['body']);
	$paras = $bodyXml->getElementsByTagName('para');

	foreach ($paras as $para) {
		$bodyEdit .= '<p>'.$para->nodeValue.'</p>'; 
	}
} else {
	$postId = ''; 
	$title = ''; 
	$bodyEdit = ''; 
	$tags = array(); 
}

if (count($tags) >  0) {
	foreach ($tags as $tagArray) {
		array_push($tagIdArray, $tagArray['tagNameId']); 
	}
}

?>

<!-- BEGIN main -->
<div>
	<!-- BEGIN post -->
	<div>	
		<h3>Post</h3>

		<form action="blog.php" method="post">
			<fieldset>
				<legend></legend>
				<p class="fieldsetLabel">Title</p>

				<div class="field">
					<label for="title">Add/edit title of post</label>
					<!-- <input id="title" type="text" name="title" value="<?php echo $title; ?>"/> -->
					<textarea id="title" name="title" rows="1"><?php echo $title; ?></textarea>
				</div>
			</fieldset>

			<fieldset>
				<legend></legend>
				<p class="fieldsetLabel">Body</p>

				<div class="field">
					<label for="body">Add/edit body of post</label>
					<textarea id="body" name="body" rows="10" class="wysiwyg"><?php echo $bodyEdit; ?></textarea>
				</div>
			</fieldset>

			<fieldset>
				<legend></legend>
				<p class="fieldsetLabel">Existing tags</p>
				<p class="fieldsetLabel">Select/deselect existing tags</p>

	<?php 

	foreach ($allTags as $allTagArray) { 

	?>

		<div class="field checkbox">
			<label for="tag_<?php echo $allTagArray['tagNameId']; ?>"><?php echo $allTagArray['name']; ?></label>
			<input id="tag_<?php echo $allTagArray['tagNameId']; ?>" type="checkbox" name="tag[<?php echo $allTagArray['tagNameId']; ?>]"

	<?php

	if (in_array($allTagArray['tagNameId'], $tagIdArray)) {
		echo '"checked"'; 
	}

	?>

				/>
			</div>

	<?php } ?>

		</fieldset>

		<fieldset>
			<legend></legend>
			<p class="fieldsetLabel">New tags</p>

			<div>
				<label for="newTags">Add new tags (comma separated list):</label>
				<input id="newTags" type="text" name="newTags" value=""/>
			</div>
		</fieldset>

		<fieldset>
	                     
	<?php if ($postId) { ?>

				<div>
					<input type="hidden" name="postId" value="<?php echo $postId; ?>"/>
					<input type="hidden" name="action" value="update"/>
					<button type="submit">Save changes</button>
				</div>

	<?php } else { ?>

				<div>
					<input type="hidden" name="action" value="insert"/>
					<button type="submit">Add new post</button>
				</div>

	<?php } ?>

			</fieldset>
		</form>
	</div>
	<!-- END post -->

<?php

if ($postId) {
	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'deleteComment') {
			$commentId = $_POST['commentId']; 
			$actionReturn = $weblog->deleteComment($commentId); 
		} elseif ($_POST['action'] == 'addComment') {
			$body = $_POST['body']; 
			$actionReturn = $weblog->saveComment(NULL, '', '', $postId, $body, ''); 
		}
	}

	$commentArray = $weblog->getComments($postId); 

	if (count($commentArray) > 0) {

?>

	<!-- BEGIN comments -->
	<div>
		<h3>Comments</h3>

	<?php

	if (isset($actionReturn)) {
		echo '<p>'.$actionReturn.'</p>'; 
	}

	// list comments for this post
	foreach ($commentArray as $comment) {

	?>

		<!-- BEGIN comment -->
		<div>
			<p>Date posted: <?php echo $weblog->formatDate($comment['timestamp']); ?></p>
			<p>IP Address: <?php echo $comment['ipAddress']; ?></p>
			<p>Author: <?php echo $comment['author']; ?></p>
			<p><?php echo $comment['body']; ?></p>
			<form action="edit.php" method="post" name="deleteComment">
				<input type="hidden" name="postId" value="<?php echo $postId; ?>"/>
				<input type="hidden" name="action" value="deleteComment"/>
				<input type="hidden" name="commentId" value="<?php echo $comment['commentId'] ?>"/>
				<button type="submit">Delete comment</button>
			</form>
		</div>
		<!-- END comment -->

<?php } ?>

		<form action="edit.php" method="post">
			<input type="hidden" name="postId" value="<?php echo $postId; ?>"/>
			<input type="hidden" name="action" value="addComment"/>

			<fieldset>
				<legend>Add a comment</legend>
				<textarea name="body" rows=5></textarea>
			</fieldset>

			<button type="submit">Add comment</button>
		</form>
	</div>
	<!-- END comments -->
</div>
<!-- END main -->

<?php

	}
}

include('common/adminFooter.php'); 

?>