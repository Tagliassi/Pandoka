<?php
require './conectaBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cliente'])) {
    $id_cliente = $_POST['id_cliente'];
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    $sql = "UPDATE Clientes SET nome='$nome', data_nascimento='$data_nascimento', cpf='$cpf', rua='$rua', numero='$numero', bairro='$bairro', cidade='$cidade', cep='$cep' WHERE id_cliente='$id_cliente'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Dados do cliente atualizados com sucesso!');</script>";
        header("Location: pagina_cliente.php");
    } else {
        echo "Erro ao atualizar dados do cliente: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Requisição inválida para atualizar o cliente.";
}
?>
