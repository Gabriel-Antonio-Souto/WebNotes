<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

    include_once("../../limpar.php");
    require_once('../../model/Usuario.php');
    require_once('../../model/Conexao.php');

    session_start();

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {
        case "POST":
            try {
               
                $con = Conexao::conectar();
                        
                $stmt = $con->prepare("SELECT idUsuario FROM tbUsuario WHERE 
                                            emailUsuario = :e");
                $stmt->bindValue(":e", $_POST['email']);
                $stmt->execute();

                if ($stmt->rowCount() == null) {

                    $msg = ['status' => false, 'msg' => 'Erro: link inválido!'];

                }else{
                            
                    if ($_POST['email'] == null) {

                        $msg = ['status' => false, 'msg' => 'Erro: link inválido!'];
                        
                    }else{
                        if($_POST['senha'] == $_POST['senha_confirmar']){

                            $usuario = new Usuario();
                            $usuario->setSenhaUsuario(base64_encode(limpar($_POST['senha'])));
                            $usuario->setLoginUsuario($_POST['email']);
                            $usuario->recuperar_senha($usuario);
                            $msg = ['status' => true, 'msg' => 'Senha alterada com sucesso!'];
                        
                        }else{
                            // erro ao recuperar
                            $msg = ['status' => false, 'msg' => 'Erro: senhas não correspondem!'];
                        }
                    }
                }
                
            } catch (Exception $error) {
                echo ("ERRO AO RECUPERAR SENHA: "+$error);
            }

            break;
        
    }
        
    $json = json_encode($msg);

    echo $json;

?>