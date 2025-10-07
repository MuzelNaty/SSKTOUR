<?php
class DefService
{
    private $def;
    private $conexao;

    public function __construct(Def $def, Conexao $conexao)
    {
        $this->conexao = $conexao->conectar();
        $this->def = $def;
    }

    public function inserir()
    {
        $query = "insert into deficiencia (tipo) 
            values (?);";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->def->__get('tipo'));
        $stmt->execute();
    }

    public function recuperar()
    {
        $query = 'select * from deficiencia';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperardef($idd)
    {
        $query = 'select * from deficiencia where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idd);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir()
    {
        $query = 'delete from deficiencia where id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->def->__get('id'));
        $stmt->execute();

    }

    public function alterar()
    {
        $query = "update deficiencia set tipo=? where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->def->__get('tipo'));
        $stmt->bindValue(2, $this->def->__get('id'));
        $stmt->execute();
    }
}
?>