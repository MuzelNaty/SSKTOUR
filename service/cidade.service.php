<?php 
    class CidadeService 
    {
        private $cidade;
        private $conexao;

        public function __construct(Cidade $cidade, Conexao $conexao)
        {
            $this->conexao = $conexao->conectar();
            $this->cidade = $cidade;
        }

        public function inserir()
        {
            $query = "insert into cidade (nome) 
            values (?);";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$this->cidade->__get('nome'));
            $stmt->execute();
            
            
        }

        public function recuperar()
        {
            $query = 'select * from cidade';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function recuperarCidade($idc)
        {
            $query = 'select * from cidade where id = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$idc);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        
        public function excluir()
        {
            $query = 'delete from cidade where id = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$this->cidade->__get('id'));
			$stmt->execute();
           
        }

        public function alterar()
        {
            $query = "update cidade set nome=? where id = ?";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$this->cidade->__get('nome'));
			$stmt->bindValue(2,$this->cidade->__get('id'));
            $stmt->execute();
            
            
        }
       
    }
?>