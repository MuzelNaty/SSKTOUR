<?php
class PontoT
{
    private $id;
    private $nome;
    private $endereco;
    private $descricao;

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