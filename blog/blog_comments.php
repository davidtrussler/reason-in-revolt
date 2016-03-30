<!-- BEGIN blog_comments -->

<?php

/*
 * display comments 
**/ 
if (isset($_SESSION['emptyFieldArray'])) {
	$emptyFieldArray = $_SESSION['emptyFieldArray']; 
}

if (isset($_SESSION['validatedEmail'])) {
	$validatedEmail = $_SESSION['validatedEmail']; 
}

if (isset($_SESSION['validCaptcha'])) {
	$validCaptcha = $_SESSION['validCaptcha']; 
}

// echo 'validCaptcha = '.$validCaptcha; 

if (isset($_SESSION['commentAuthor'])) {
	$commentAuthor = $_SESSION['commentAuthor']; 
} else {
	$commentAuthor = ''; 
}

if (isset($_SESSION['commentEmail'])) {
	$commentEmail = $_SESSION['commentEmail']; 
} else {
	$commentEmail = ''; 
}

if (isset($_SESSION['commentWebsite'])) {
	$commentWebsite = $_SESSION['commentWebsite']; 
} else {
	$commentWebsite = ''; 
}

if (isset($_SESSION['commentBody'])) {
	$commentBody = $_SESSION['commentBody']; 
} else {
	$commentBody = ''; 
}

$comments = $weblog->getComments($postId); 

if (count($comments) > 0) {
	$i = 0; 

	echo '<div>
		<h3>Comments</h3>';
			
	if (isset($saveComment)) {
		echo '<p>'.$saveComment.'</p>'; 
	}

	foreach ($comments as $comment) {
		$timestamp = $comment['timestamp']; 
		$author = $comment['author']; 
			if ($author == '') {
				$author = 'David Trussler'; 
				$sectionClass = 'owner'; 
			}
		$website = $comment['website']; 
		$body = $comment['body']; 
		$date = $weblog->formatDate($timestamp); 
		
		$i++; 

		if (isset($_GET['saved']) && $_GET['saved'] == 'yes' && $i == count($comments)) {
			echo '<p>Your comment was saved.</p>'; 
		}
		
?>

	<div>
		<p><?php echo $date; ?></p>
		
<?php

		if ($website) {
			echo '<p><a href="http://'.$website.'">'.$author.'</a></p'; 
		} else {
			echo '<p>'.$author.'</p>'; 
		}

?>

		<p><?php echo $body; ?></p>
	</div>

<?php

	}

?>

</div>

<?php

}

?>

 

<?php 

// only show comments if the post is less than a defined age.
if ($postAge > $COMMENT_EXPIRE) {
	echo 
		'<div>
			<p>Adding comments has now expired for this post.</p>
		</div>'; 
} else {
	echo '<div>'; 

?>

	<h3>Add a comment</h3>

<?php

if (isset($_SESSION['saveComment'])) {
	
?>
	
		<p class="warning">There are problems with your comment. </p>
	
<?php 
	
	foreach($_SESSION['saveComment'] as $comment) { 
		
?>

		<p class="warning"><?php echo $comment; ?></p>

<?php 

	}
}

?>

		<form action="<?php echo $SERVER_ROOT; ?>/blog_comment_save/<?php echo $postId; ?>" method="post">
			<input type="hidden" name="action" value="saveComment"/>
	
			<fieldset>
				<!-- name -->
				<div>

<?php

if (isset($emptyFieldArray) && in_array('name', $emptyFieldArray)) {
	echo '<p class="warning">Please enter your name below</p>'; 
}

?>

					<label for="name">Your name:</label>
					<input 
						type="text" 
						name="name" 
						value="<?php echo $commentAuthor; ?>" 
						id="name"
						placeholder="name"
					/>
				</div> 
				<!-- end name -->
	
				<!-- email address -->
				<div>

<?php

if (isset($emptyFieldArray) && in_array('email', $emptyFieldArray)) {
	echo '<p class="warning">Please enter your email address below</p>'; 
} elseif (isset($validatedEmail) && $validatedEmail == 'invalid') {
	echo '<p class="warning">Please enter a valid email address below</p>'; 
}

?>

					<label for="email">Your email address (this will not be published):</label>
					<input 
						type="email" 
						name="email" 
						value="<?php echo $commentEmail; ?>" 
						id="email"
						placeholder="email"
					/>
				</div> 
				<!-- end email address -->
	
				<!-- web address -->
				<div>
					<label for="website">Your website address (optional):</label>
					<input 
						type="url" 
						name="website" 
						value="<?php echo $commentWebsite; ?>" 
						id="website"
						placeholder="website"
					/>
				</div> 
				<!-- end web address -->
	
				<!-- comment -->
				<div>

<?php

if (isset($emptyFieldArray) && in_array('comment', $emptyFieldArray)) {
	echo '<p class="warning">Please enter your comment below</p>'; 
}

?>

					<label for="comment">Your comment:</label>
					<textarea name="comment" id="comment"><?php echo $commentBody; ?></textarea>
				</div>
				<!-- end comment -->
	
				<!-- notify -->
				<div>
					<input id="notify" type="checkbox" name="notify"/>
					<label for="notify">Tick here to be notified of further comments on this post</label>
				</div> 
				<!-- end notify -->
	
				<!-- captcha -->
				<div>

<?php

$captcha_value_1 = rand(0, 10); 
$captcha_value_2 = rand(0, 10); 
$captcha_validate = $captcha_value_1 + $captcha_value_2; 

if (isset($validCaptcha) && $validCaptcha == 'invalid') {
	echo '<p class="warning">Please answer the question below</p>'; 
}

?>

					<label for="captcha">Answer this question: <?php echo $captcha_value_1; ?> + <?php echo $captcha_value_2; ?> = </label>
					<input 
						type="text" 
						min="0"
						max="20"
						step="1"
						name="captcha_input" 
						value=""
					/>
					<input type="hidden" name="captcha_validate" value="<?php echo $captcha_validate; ?>"/>
				</div> 
				<!-- end captcha -->
	
				<!-- actions -->
				<div>
					<button>Post your comment</button>
				</div>
				<!-- end actions -->
			</fieldset>
		</form>
	</div>

<?php

}

?>
<!-- END blog_comments -->