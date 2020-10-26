<?php 
// Performance testing (Start counting microtime and display duration at end of file)
// Assumes everything goes through this file start to finish
$start = microtime(true);
echo '<pre>';

include 'Platform.php';
$platform = new Platform();


echo '<br/>mining block 1...<br/>';
$platform->push(new Block(1,strtotime('now'),"amount: 5"));

echo '<br/>mining block 2...<br/>';
$platform->push(new Block(1,strtotime('now'),"amount: 10"));

echo '<br/>mining block 3...<br/>';
$platform->push(new Block(1,strtotime('now'),"amount: 3"));

//Validate chain
echo "<br/>Chain valid: ".($platform->isValid() ? "true" : "false").'<br/>';



//Let's get the last block
echo '<br/>Last block: ';
print_r($platform->getLastBlock());
echo '<br/>';

//display chain

echo json_encode($platform->getChain(), JSON_PRETTY_PRINT);


//Let's try to hack the chain
echo 'changing amount in chain';
$platform->chain[3]->data = "amount: 1000";
$platform->chain[3]->hash = $platform->chain[1]->calculateHash();

echo "<br/>Chain valid: ".($platform->isValid() ? "true" : "false").'<br/>';
echo json_encode($platform->getChain(), JSON_PRETTY_PRINT);

echo '</pre>';

// Performance testing
$finish = microtime(true);
echo 'Script execution duration:'.sprintf($finish - $start);

?>
