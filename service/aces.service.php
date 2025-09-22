<?php
class AcesService
{
    private $aces;
    private $conexao;

    public function __construct(Aces $aces, Conexao $conexao)
    {
        $this->conexao = $conexao->conectar();
        $this->aces = $aces;
    }

    public function inserir()
    {
        $query = "insert into aces (tipo) 
            values (?);";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->aces->__get('tipo'));
        $stmt->execute();
    }

    public function recuperar()
    {
        $query = 'select * from aces';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperaraces($ida)
    {
        $query = 'select * from aces where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $ida);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir()
    {
        $query = 'delete from aces where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->aces->__get('id'));
        $stmt->execute();

    }

    public function alterar()
    {
        $query = "update aces set nome=? where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->aces->__get('tipo'));
        $stmt->bindValue(2, $this->aces->__get('id'));
        $stmt->execute();
    }
}
?>