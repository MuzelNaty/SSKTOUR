<?php
class PontoTService
{
    private $pontoT;
    private $conexao;

    public function __construct(PontoT $pontoT, Conexao $conexao)
    {
        $this->conexao = $conexao->conectar();
        $this->pontoT = $pontoT;
    }

    public function inserir()
    {
        $query = "insert into pontoT (nome, endereco, descricao) 
            values (?);";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->pontoT->__get('nome'));
        $stmt->bindValue(2, $this->pontoT->__get('endereco'));
        $stmt->bindValue(3, $this->pontoT->__get('descricao'));
        $stmt->execute();
    }

    public function recuperar()
    {
        $query = 'select * from pontoT';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperarpontoT($idc)
    {
        $query = 'select * from pontoT where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idc);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir()
    {
        $query = 'delete from pontoT where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->pontoT->__get('id'));
        $stmt->execute();
    }

    public function alterar()
    {
        $query = "update pontoT set nome=?, endereco=?, descricao=? where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->pontoT->__get('nome'));
        $stmt->bindValue(2, $this->pontoT->__get('endereco'));
        $stmt->bindValue(3, $this->pontoT->__get('descricao'));
        $stmt->bindValue(4, $this->pontoT->__get('id'));
        $stmt->execute();
    }
}
?>