<?php
require './conectaBD.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_funcionario = $_GET['id'];

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM Funcionarios WHERE id_funcionario = $id_funcionario";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $sql_delete = "DELETE FROM Funcionarios WHERE id_funcionario = $id_funcionario";

        if (mysqli_query($conn, $sql_delete)) {
            echo "<script>alert('Funcionário excluído com sucesso!');</script>";
            // Redirecionar para a página de administração após a exclusão
            header("Location: admin.php");
        } else {
            echo "Erro ao excluir funcionário: " . mysqli_error($conn);
        }
    } else {
        echo "Funcionário não encontrado.";
    }

    mysqli_close($conn);
} else {
    echo "ID do funcionário não fornecido.";
}
?>
