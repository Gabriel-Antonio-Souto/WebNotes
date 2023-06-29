<?php

    require_once('Conexao.php');

    class Anotacoes
    {
        // atributos
        private $idAnotacao;
        private $tituloAnotacao;
        private $textoAnotacao;
        private $idUsuario;

        // Getters
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function getIdAnotacao(){
            return $this->idAnotacao;
        }
        public function getTituloAnotacao(){
            return $this->tituloAnotacao;
        }
        public function getTextoAnotacao(){
            return $this->textoAnotacao;
        }

        // Setters
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }
        public function setIdAnotacao($idAnotacao){
            $this->idAnotacao = $idAnotacao;
        }
        public function setTituloAnotacao($tituloAnotacao){
            $this->tituloAnotacao = $tituloAnotacao;
        }
        public function setTextoAnotacao($textoAnotacao){
            $this->textoAnotacao = $textoAnotacao;
        }

        public function salvar($anotacao){
            $con = Conexao::conectar();
            
            $stmt = $con->prepare("INSERT INTO tbTexto(tituloTexto, texto, idUsuario)
                                    VALUES (?,?,?)");
            $stmt->bindValue(1, $anotacao->getTituloAnotacao());
            $stmt->bindValue(2, $anotacao->getTextoAnotacao());
            $stmt->bindValue(3, $anotacao->getIdUsuario());
 
            $stmt->execute();
        }

        // métodos
        public function listar(){
            $conexao = Conexao::conectar();
            $querySelect = "SELECT * FROM tbTexto";
            $resultado = $conexao->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        public function alterar($anotacao){
            $con = Conexao::conectar();

            $stmt = $con->prepare("UPDATE tbTexto SET tituloTexto = ?, texto = ? where idTexto = ?");
            $stmt->bindValue(1, $anotacao->getTituloAnotacao());
            $stmt->bindValue(2, $anotacao->getTextoAnotacao());
            $stmt->bindValue(3, $anotacao->getIdAnotacao());

            $stmt->execute();
        }

        public function excluir($anotacao){
            $con = Conexao::conectar();
            $stmt = $con->prepare("DELETE FROM tbTexto where idTexto = ?");
            $stmt->bindValue(1, $anotacao->getIdAnotacao());
            
            $stmt->execute();
        }
    }

?>