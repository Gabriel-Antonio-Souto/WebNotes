<?php

    class Conexao
    {
        // método
        public static function conectar()
        {
            try { 
                //conexão local
                $conexao = new PDO("mysql:host=localhost;dbname=bdProjeto", "root","123456");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->exec("SET CHARACTER SET utf8");    
                return $conexao;

            } catch (Exception $error) {
                echo ("ERRO AO CONECTAR: "+$error);
            }
        }
    }

?>