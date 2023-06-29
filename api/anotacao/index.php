<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-type: application/json; charset=utf-8");

    require_once('../model/Anotacoes.php');
    require_once('../model/Conexao.php');

    session_start();

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {
        case 'GET':
            try {
                $anotacao = new Anotacoes();
                $con = Conexao::conectar();

                if (isset($_GET['id'])) {

                    $id = $_GET['id'];
                
                    $sql = "SELECT * FROM tbTexto WHERE idTexto = $id";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();
                    $listaAnotacao = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $msg = $listaAnotacao;

                }else{

                    $listaAnotacao = $anotacao->listar();

                    $msg = ['status' => 200, 'dados' => $listaAnotacao];
                    
                }

            } catch(Exception $e) {
                
                echo $e->getMessage();
            }
            break;
        case "POST":
            try {

                $anotacao = new Anotacoes();

                if($_POST['id'] == null){             
                    $anotacao->setTituloAnotacao($_POST['titulo']);
                    $anotacao->setTextoAnotacao($_POST['texto']);
                    $anotacao->setIdUsuario($_SESSION['id']);
                    $anotacao->salvar($anotacao);
                    $msg = ['status' => true, 'msg' => 'Anotação salva com sucesso!'];
                }else{
                    $anotacao->setTituloAnotacao($_POST['titulo']);
                    $anotacao->setTextoAnotacao($_POST['texto']);
                    $anotacao->setIdAnotacao($_POST['id']);
                    $anotacao->alterar($anotacao);
                    $msg = ['status' => true, 'msg' => 'Anotação atualizada com sucesso!'];
                }
              
            } catch (Exception $error) {
                echo ("ERRO: "+$error);
            }

            break;
        case 'DELETE':
            try {

                $anotacao = new Anotacoes();

                $anotacao->setIdAnotacao($_GET['id']);

                $anotacao->excluir($anotacao);

                $msg = ['status' => true, 'msg' => 'Anotação excluida com sucesso!'];
                
            } catch (Exception $error) {
                echo ("ERRO AO EXCLUIR: "+$error);
            }
            
            break;
    }

    $json = json_encode($msg);

    echo $json;
?>