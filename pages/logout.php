<?php
    // destruir sessão
    session_start();
    unset($_SESSION['id'],$_SESSION['email'],$_SESSION['nome']);
    session_destroy();
    header("Location: /webnotes");

?>