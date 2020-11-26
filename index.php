<?php 
// Performance testing (Start counting microtime and display duration at end of file)
// Assumes everything goes through this file start to finish
$start = microtime(true);
echo '<pre>';

include 'Platform.php';
$platform = new Platform();
echo json_encode($platform->getLastBlock(), JSON_PRETTY_PRINT);


echo '</pre>';

// Performance testing
$finish = microtime(true);
echo 'Script execution duration:'.sprintf($finish - $start);

?>
