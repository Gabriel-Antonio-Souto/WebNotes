<?php
	header("Location: configuracoes");

	$cor = $_POST['corSelect'];

	setcookie('corCookie',$cor);
?>