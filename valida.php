<?php
session_start();

// Incluindo a conexão com o banco de dados
include_once("conexao.php");

// O campo user e senha preenchido entra no if para validar
if (isset($_POST['email']) && isset($_POST['senha'])) {

    $user = mysqli_real_escape_string($conn, $_POST['email']); 
    // Omitir caracteres especiais, como aspas, prevenindo SQL injection

    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $senha = md5($senha);

    // Buscar na tabela users o user que corresponde aos dados digitados no formulário
    $result_user = "SELECT * FROM users WHERE email = '$user' && senha = '$senha' LIMIT 1";
    $resultado_user = mysqli_query($conn, $result_user);
    $resultado = mysqli_fetch_assoc($resultado_user);

    // Encontrando um user na tabela users com os mesmos dados digitados no formulário
    if (isset($resultado)) {

        $_SESSION['userId'] = $resultado['id'];
        $_SESSION['userNome'] = $resultado['nome'];
        $_SESSION['userNiveisAcessoId'] = $resultado['niveis_acesso_id'];
        $_SESSION['userEmail'] = $resultado['email'];

        if ($_SESSION['userNiveisAcessoId'] == "1") {
            header("Location: administrativo.php");
        } elseif ($_SESSION['userNiveisAcessoId'] == "2") {
            header("Location: colaborador.php");
        } else {
            header("Location: cliente.php");
        }

    } else {
        // Não foi encontrado um user na tabela users com os mesmos dados digitados no formulário
        // Redireciona o user para a página de login
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header("Location: index.php");
    }
        //O campo user e senha não preenchido entra no else e redireciona o user para a
    }else{
        $_SESSION['loginErro'] = "User ou senha inválido";

        header("Location: index.php");

}
?>

