<!-- BEGIN nav -->
<ul>

<?php

// identify if the link is to the current page
foreach($link_array as $url => $title) {
	$dest = explode('?', $url)[0]; 
	$thisPage = array_pop(explode('/', $self));

	if ($dest == 'home') {
		$dest = 'index'; 
	}

	if (stripos($thisPage, $dest) !== false) {
		echo '<li class="live">'.$title.'</li>'; 
	} else {
		echo '<li><a href="'.$SERVER_ROOT.$url.'">'.$title.'</a></li>'; 
	}
}

?>

</ul>
<!-- END nav -->
