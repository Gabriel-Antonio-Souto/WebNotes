<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

    include_once("../limpar.php");
    require_once('../model/Conexao.php');

    session_start();

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {
        case "POST":
            try {
                $con = Conexao::conectar();
        
                $email_login = limpar($_POST['email_login']);
                $senha = limpar($_POST['senha_login']);
                $senha_login = base64_encode($senha);
                // listar usuário
                $stmt = $con->prepare("SELECT * FROM tbUsuario WHERE emailUsuario = :e and senhaUsuario = :s");
                $stmt->bindValue(":e", $email_login);
                $stmt->bindValue(":s", $senha_login);
                $stmt->execute();

                $id_banco = '';
                $email_banco = '';
                $nome = '';
                $senha_banco = '';

                while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                    $id_banco = $row['idUsuario'];
                    $email_banco = $row['emailUsuario'];
                    $nome_banco = $row['nomeUsuario'];
                    $senha_banco = $row['senhaUsuario'];
                }

                if (($email_login == $email_banco)&& ($senha_login == $senha_banco)){

                    $_SESSION['id'] = $id_banco;
                    $_SESSION['email'] = $email_banco;
                    $_SESSION['nome'] = $nome_banco;
                    $_SESSION['senha'] = $senha_banco;

                    $msg = ['status' => true, 'msg' => 'Login realizado com sucesso!'];
    
                }else{
                    
                    $msg = ['status' => false, 'msg' => 'Usuário ou senha incorretos!'];

                }
                
            } catch (Exception $error) {
                echo ("ERRO AO LOGAR: "+$error);
            }
    }
        
    $json = json_encode($msg);

    echo $json;

?>