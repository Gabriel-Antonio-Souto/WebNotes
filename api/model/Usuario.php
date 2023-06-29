<?php

    require_once('Conexao.php');
  
    class Usuario
    {
        // atributos
        private $idUsuario;
        private $nomeUsuario;
        private $loginUsuario;
        private $senhaUsuario;

        // Getters
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function getNomeUsuario(){
            return $this->nomeUsuario;
        }
        public function getLoginUsuario(){
            return $this->loginUsuario;
        }
        public function getSenhaUsuario(){
            return $this->senhaUsuario;
        }

        // Setters
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        public function setNomeUsuario($nomeUsuario){
            $this->nomeUsuario = $nomeUsuario;
        }
        public function setLoginUsuario($loginUsuario){
            $this->loginUsuario = $loginUsuario;
        }
        public function setSenhaUsuario($senhaUsuario){
            $this->senhaUsuario = $senhaUsuario;
        }

        // métodos
        public function cadastrar($usuario){
            $con = Conexao::conectar();
            
            $stmt = $con->prepare("INSERT INTO tbUsuario(nomeUsuario, emailUsuario, senhaUsuario)
                                    VALUES (?,?,?)");
            $stmt->bindValue(1, $usuario->getNomeUsuario());
            $stmt->bindValue(2, $usuario->getLoginUsuario());
            $stmt->bindValue(3, $usuario->getSenhaUsuario());  

            $stmt->execute();

            $id = $con->lastInsertId();

            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $usuario->getNomeUsuario();
            $_SESSION['email'] = $usuario->getLoginUsuario();
            $_SESSION['senha'] = $usuario->getSenhaUsuario();
        }
        public function alterar($usuario){
            $con = Conexao::conectar();

            $stmt = $con->prepare("UPDATE tbUsuario SET nomeUsuario = ?, emailUsuario = ? where idUsuario = ?");
            $stmt->bindValue(1, $usuario->getNomeUsuario());
            $stmt->bindValue(2, $usuario->getLoginUsuario());
            $stmt->bindValue(3, $usuario->getIdUsuario());

            $stmt->execute();
        }
        public function alterar_senha($usuario){
            $con = Conexao::conectar();

            $stmt = $con->prepare("UPDATE tbUsuario SET senhaUsuario = ? where idUsuario = ?");
            $stmt->bindValue(1, $usuario->getSenhaUsuario());
            $stmt->bindValue(2, $usuario->getIdUsuario());

            $stmt->execute();
        }
        public function recuperar_senha($usuario){
            $con = Conexao::conectar();

            $stmt = $con->prepare("UPDATE tbUsuario SET senhaUsuario = ? where emailUsuario = ?");
            $stmt->bindValue(1, $usuario->getSenhaUsuario());
            $stmt->bindValue(2, $usuario->getLoginUsuario());

            $stmt->execute();
        }
        public function listar(){
            $conexao = Conexao::conectar();
            $querySelect = "SELECT * FROM tbUsuario";
            $resultado = $conexao->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;
        }
        public function excluir($usuario){
            $con = Conexao::conectar();

            $stmt = $con->prepare("DELETE FROM tbTexto where idUsuario = ?");
            $stmt->bindValue(1, $usuario->getIdUsuario());
            
            $stmt->execute();

            $stmt1 = $con->prepare("DELETE FROM tbUsuario where idUsuario = ?");
            $stmt1->bindValue(1, $usuario->getIdUsuario());
            
            $stmt1->execute();

        
        }
    }

?>