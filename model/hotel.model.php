<?php
class Cidade
{
    private $id;
    private $nome;
    private $endereco;
    private $cidade_id;

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