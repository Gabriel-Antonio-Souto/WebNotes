<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

    include_once("../../limpar.php");
    require_once('../../model/Usuario.php');

    session_start();

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {
        case "POST":
            try {
                $senha_atual = base64_decode($_SESSION['senha']);

                if ($senha_atual != $_POST['senha']) {

                    $msg = ['status' => false, 'msg' => 'Erro: senha atual incorreta!'];

                }else{

                    if($_POST['nova_senha'] == $_POST['nova_confirmar']){

                        $usuario = new Usuario();
                        $usuario->setSenhaUsuario(base64_encode(limpar($_POST['nova_senha'])));
                        $usuario->setIdUsuario($_SESSION['id']);
                        $usuario->alterar_senha($usuario);
                        $msg = ['status' => true, 'msg' => 'Senha alterada com sucesso!'];
                    
                    }else{
                        // erro ao alterar
                        $msg = ['status' => false, 'msg' => 'Erro: senhas não correspondem!'];
                    }
                }
                
            } catch (Exception $error) {
                echo ("ERRO AO ATUALIZAR: "+$error);
            }

            break;
        
    }
        
    $json = json_encode($msg);

    echo $json;

?>