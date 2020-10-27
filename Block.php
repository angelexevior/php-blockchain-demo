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
    
    //Used when creating a new block
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
        //Using sha256. Could be altered with any encryption algorithm
        //*tip For php the argon2 library is fast and efficient
        return hash("sha256", $this->index.$this->previousHash.$this->timestamp.((string)$this->data).$this->nonce);
    }
    
   
}