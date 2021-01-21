<?php 
// Performance testing (Start counting microtime and display duration at end of file)
// Assumes everything goes through this file start to finish
$start = microtime(true);
echo '<pre>';

include 'Platform.php';
$platform = new Platform();
//echo json_encode($platform->getLastBlock(), JSON_PRETTY_PRINT);

echo '<br/>mining block 1...<br/>';
$platform->push(new Block(1,strtotime('now'),"amount: 5"));

echo '<br/>mining block 2...<br/>';
$platform->push(new Block(1,strtotime('now'),"amount: 10"));

echo '<br/>mining block 3...<br/>';
$platform->push(new Block(1,strtotime('now'),"amount: 3"));

echo '<br/>'.json_encode($platform->getChain(), JSON_PRETTY_PRINT);


echo "<br/>Chain valid: ".($platform->isValid() ? "true" : "false").'<br/>';




$platform->chain[2]->data = "amount: 1000";
echo '<br/>'.json_encode($platform->getChain(), JSON_PRETTY_PRINT);

echo "<br/>Chain valid: ".($platform->isValid() ? "true" : "false").'<br/>';

echo '</pre>';
// Performance testing
$finish = microtime(true);
echo 'Script execution duration:'.sprintf($finish - $start);

?>
