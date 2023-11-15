<?php
session_start();
require '../../../Back-End/PHP/conectaBD.php';

// Cria conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica conexão
if (!$conn) {
    die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
}
// Configura para trabalhar com caracteres acentuados do português
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];

    // Verifica se é um cliente
    $query_cliente = "SELECT * FROM Clientes WHERE cpf = '$login'";
    $result_cliente = $conn->query($query_cliente);

    if ($result_cliente->num_rows == 1) {
        $cliente = $result_cliente->fetch_assoc();
        $_SESSION['login'] = $login;
        $_SESSION['id_cliente'] = $cliente['id_cliente'];
        header("Location: ../../../Front-End/HTML/Pagina_Principal/pagina_cliente.php");
        exit();
    }

    // Verifica se é um funcionário
    $query_funcionario = "SELECT * FROM Funcionarios WHERE nome = '$login'";
    $result_funcionario = $conn->query($query_funcionario);

    if ($result_funcionario->num_rows == 1) {
        $funcionario = $result_funcionario->fetch_assoc();
        $_SESSION['login'] = $login;
        $_SESSION['id_funcionario'] = $funcionario['id_funcionario'];
        header("Location: ../../../Front-End/HTML/Pagina_Principal/pagina_funcionario.php");
        exit();
    }

    echo "Login inválido para clientes ou funcionários.";
}
?>

<!-- Formulário de Login -->
<form method="post" action="">
    <label for="login">Login (CPF para clientes / Nome para funcionários):</label><br>
    <input type="text" id="login" name="login"><br>
    <input type="submit" value="Entrar">
</form>

<!-- Link para a página de cadastro -->
<a href="./sign.php">Cadastrar</a>
