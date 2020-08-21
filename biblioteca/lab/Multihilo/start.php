<?php

class MyThread extends Thread {
    public function run(){
        //do something time consuming
    }

    public function isGarbage(): bool {
        
    }

    public function offsetExists($offset): bool {
        
    }

    public function offsetGet($offset) {
        
    }

    public function offsetSet($offset, $value): void {
        
    }

    public function offsetUnset($offset): void {
        
    }

    public function setGarbage(): void {
        
    }

}

$t = new MyThread();
if($t->start()){
    while($t->isRunning()){
        echo ".";
        usleep(100);
    }
    $t->join();
}
