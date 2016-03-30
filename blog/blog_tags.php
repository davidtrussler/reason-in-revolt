<h4>Tags</h4>

<ul>

<?php

$tags = $weblog->getTags(); 

foreach($tags as $tagArray) {

?>

	<li><a href="blog.php?tagNameId=<?php echo $tagArray['tagNameId']; ?>"><?php echo $tagArray['name']; ?></a></li>

<?php 

} 

?>

</ul>