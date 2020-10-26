<?php

/**
 * Block class for php blockchain platform
 *
 * @author exevior
 */
class Block {
    
    public $nonce;
    public $timestamp;
    public $data;
    public $index;
    public $hash;
    public $previousHash;
    
    function block($index, $timestamp, $data, $previoushash = null){
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
        $this->nonce = 0;

    }
    
    /**
     * Hash encryption algorithm
     */
    public function calculateHash()
    {
        return hash("sha256", $this->index.$this->previousHash.$this->timestamp.((string)$this->data).$this->nonce);
    }
    
   
}