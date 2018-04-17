<?php
class Test implements Iterator
{
    private $testing = [0,1,2,3,4,5,6,7,8,9,10];
    private $index = 0;

    public function current()
    {
        return $this->testing[$this->index];
    }

    public function next()
    {
        $this->index ++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return isset($this->testing[$this->key()]);
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function reverse()
    {
        $this->testing = array_reverse($this->testing);
        $this->rewind();
    }
}

$tests = new Test();
$ele = $tests.next();
echo $ele;
?>