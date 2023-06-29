<?php
    // valida sentinela
    session_start();
    $msg = "<script> Swal.fire({text: 'Erro: Necessário realizar login!',icon: 'error',showCancelButton: false,confirmButtonColor: '#3085d6',confirmButtonText: 'Fechar'}); </script>";
    // se as sessões não existirem 
    if((!isset($_SESSION['id'])) and (!isset($_SESSION['nome']))){
        $_SESSION['msg'] = $msg;
        header("Location: /webnotes");
    }
?>