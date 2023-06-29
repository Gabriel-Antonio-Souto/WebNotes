<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-type: application/json; charset=utf-8");

    include_once("../limpar.php");
    require_once('../model/Usuario.php');
    require_once('../model/Conexao.php');

    session_start();

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {
        case 'GET':
            try {

                $usuario = new Usuario();
                
                $lista = $usuario->listar();

                $msg = ['status' => 200, 'dados' => $lista];

            } catch(Exception $e) {
                
                echo $e->getMessage();
            }
            break;
        case "POST":
            try {
                
                if($_POST['senha'] == $_POST['confirmar']){

                    $usuario = new Usuario();
                    
                    $con = Conexao::conectar();
                        
                    $stmt = $con->prepare("SELECT idUsuario FROM tbUsuario WHERE 
                                            emailUsuario = :e");
                    $stmt->bindValue(":e", $_POST['email']);
                    $stmt->execute();
                    // verifica se o usuário já existe
                    if($stmt->rowCount() > 0){

                        $msg = ['status' => false, 'msg' => 'Erro: Usuário já cadastrado!'];
                
                    }else{
                        // cadastrar
                        $usuario->setNomeUsuario(limpar($_POST['nome']));
                        $usuario->setLoginUsuario(limpar($_POST['email']));
                        $usuario->setSenhaUsuario(base64_encode(limpar($_POST['senha'])));
                        $usuario->cadastrar($usuario);
                        $msg = ['status' => true, 'msg' => 'Cadastro realizado com sucesso!'];
                    }
                }else{
                    // erro ao cadastrar
                    $msg = ['status' => false, 'msg' => 'Erro: senhas não correspondem!'];
                }
              
                
            } catch (Exception $error) {
                echo ("ERRO AO CADASTRAR: "+$error);
            }

            break;
        case "PUT":
            try {
                
                $usuario = new Usuario();

                $con = Conexao::conectar();
                        
                $stmt = $con->prepare("SELECT idUsuario FROM tbUsuario WHERE 
                                        emailUsuario = :e");
                $stmt->bindValue(":e", $_GET['email']);
                $stmt->execute();
                // verifica se o usuário já existe
                if($_SESSION['email'] != $_GET['email']){
                    if($stmt->rowCount() > 0){

                        $msg = ['status' => false, 'msg' => 'Erro: Usuário já cadastrado!'];
                
                    }else{
                    // atualizar
                        $usuario->setNomeUsuario($_GET['nome']);
                        $usuario->setLoginUsuario($_GET['email']);
                        $usuario->setIdUsuario($_GET['id']);
                        $usuario->alterar($usuario);
                        $_SESSION['email'] = $_GET['email'];
                        $msg = ['status' => true, 'msg' => 'Dados atualizados com sucesso!'];
                    }
                }else{
                    
                    // atualizar
                    $usuario->setNomeUsuario($_GET['nome']);
                    $usuario->setLoginUsuario($_GET['email']);
                    $usuario->setIdUsuario($_GET['id']);
                    $usuario->alterar($usuario);
                    $_SESSION['email'] = $_GET['email'];
                    $msg = ['status' => true, 'msg' => 'Dados atualizados com sucesso!'];
                
                }

            } catch (Exception $error) {
                echo ("ERRO AO ATUALIZAR: "+$error);
            }

            break;
        case "DELETE":
            try {

                $usuario = new Usuario();

                $usuario->setIdUsuario($_GET['id']);

                $usuario->excluir($usuario);

                $msg = ['status' => true, 'msg' => 'Conta excluida com sucesso!'];

                unset($_SESSION['id'],$_SESSION['email'],$_SESSION['nome']);
                
                session_destroy();
                
            } catch (Exception $error) {

                echo ("ERRO AO EXCLUIR CONTA: "+$error);
            }

            break;
    }
        
    $json = json_encode($msg);

    echo $json;

?>