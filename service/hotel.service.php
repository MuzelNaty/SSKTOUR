<?php
class HotelService
{
    private $hotel;
    private $conexao;

    public function __construct(Hotel $hotel, Conexao $conexao)
    {
        $this->conexao = $conexao->conectar();
        $this->hotel = $hotel;
    }

    public function inserir()
    {
        $query = "insert into hotel (nome, endereco) 
            values (?);";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->hotel->__get('nome'));
        $stmt->bindValue(2, $this->hotel->__get('endereco'));
        $stmt->execute();
    }

    public function recuperar()
    {
        $query = 'select * from hotel';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperarhotel($idc)
    {
        $query = 'select * from hotel where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idc);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir()
    {
        $query = 'delete from hotel where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->hotel->__get('id'));
        $stmt->execute();

    }

    public function alterar()
    {
        $query = "update hotel set nome=?, endereco=? where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->hotel->__get('nome'));
        $stmt->bindValue(2, $this->hotel->__get('endereco'));
        $stmt->bindValue(3, $this->hotel->__get('id'));
        $stmt->execute();
    }
}
?>