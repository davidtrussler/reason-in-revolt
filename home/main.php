<!-- BEGIN main -->
<?php

$weblog = new Weblog($DOC_ROOT);

// TODO - get blog posts as object not 2 db requests
$postIdArray = $weblog->getPostIds('', ''); 

include ('primary.php');
include ('secondary.php');

?>
<!-- END main -->
