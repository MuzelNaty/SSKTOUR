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
        $query = "insert into pontoturistico (nome, endereco, cidade_id) 
            values (?,?,?);";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->pontoT->__get('nome'));
        $stmt->bindValue(2, $this->pontoT->__get('endereco'));
        $stmt->bindValue(3, $this->pontoT->__get('cidade_id'));
        $stmt->execute();
    }

    public function recuperar()
    {
        $query = 'select * from pontoturistico';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperarPontoT($idp)
    {
        $query = 'select * from pontoturistico where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idp);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir()
    {
        $query = 'delete from pontoturistico where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->pontoT->__get('id'));
        $stmt->execute();
    }

    public function alterar()
    {
        $query = "update pontoturistico set nome=?, endereco=?, cidade_id=? where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->pontoT->__get('nome'));
        $stmt->bindValue(2, $this->pontoT->__get('endereco'));
        $stmt->bindValue(3, $this->pontoT->__get('cidade_id'));
        $stmt->bindValue(4, $this->pontoT->__get('id'));
        $stmt->execute();
    }
}
?>