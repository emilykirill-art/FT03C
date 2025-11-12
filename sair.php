<?php
    session_start();
    unset(
        $_SESSION['userId'],
        $_SESSION['userNome'],
        $_SESSION['userNiveisAcessoId'],
        $_SESSION['userEmail'],
        $_SESSION['userSenha']
);


$_SESSION['logindeslogado'] = "Sessão terminada com sucesso";
//redirecionar o utilizador para a página de login
header("Location: index.php");
?>
