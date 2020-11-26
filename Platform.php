<?php

/**
 * PHP Blockchain Platform
 *
 * @author exevior
 */
include("Block.php");

class Platform {

    public $db;
    public $config;
    
    //Our constructor 
    //Initializes the chain stdclass (object) with the genesis block
    public function __construct() {
        $this->chain = [$this->createGenesisBlock()];
        $this->difficulty = 2;
    }

    //Generate genesis block
    private function createGenesisBlock() {
        return new Block(0, strtotime("2017-01-01"), "Genesis Block");
    }

    //Get the last block from the chain
    public function getLastBlock() {
        return $this->chain[count($this->chain) - 1];
    }
    
    //Get entire chain
    public function getChain(){
        return $this->chain;
    }

    //Push new block
    //Usage push(new Block(index,timestamp,data));
    public function push($block) {
        
        $block->previousHash = $this->getLastBlock()->hash;
        $this->mine($block);
        array_push($this->chain, $block);
    }

    //Used above by push()
    public function mine($block) {
        //Sample difficulty algorithm
        //Keep generating new hash until hash begins with 0000 
        //(How many zeroes depends on difficulty specified in constructor)
        while (substr($block->hash, 0, $this->difficulty) !== str_repeat("0", $this->difficulty)) {
            $block->nonce++;
            $block->hash = $block->calculateHash();
            
        }
        
        echo "Block mined: " . $block->hash . "\n";
    }

    //Validate the chain hasn't been altered or malformed
    public function isValid() {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->hash != $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previousHash != $previousBlock->hash) {
                return false;
            }
        }

        return true;
    }

}