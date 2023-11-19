<?php
require './conectaBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_funcionario'])) {
    $id_funcionario = $_POST['id_funcionario'];
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $salario = $_POST['salario'];

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    $sql = "UPDATE Funcionarios SET nome='$nome', data_nascimento='$data_nascimento', salario='$salario' WHERE id_funcionario='$id_funcionario'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Dados do funcionário atualizados com sucesso!');</script>";
        header("Location: admin.php");
    } else {
        echo "Erro ao atualizar dados do funcionário: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Requisição inválida para atualizar o funcionário.";
}
?>
