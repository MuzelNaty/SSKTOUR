<?php
class Aces
{
    private $id;
    private $tipo;

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function __get($atribute)
    {
        return $this->$atribute;
    }
}
?>