<?php
require './conectaBD.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM Clientes WHERE id_cliente = $id_cliente";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $sql_delete = "DELETE FROM Clientes WHERE id_cliente = $id_cliente";

        if (mysqli_query($conn, $sql_delete)) {
            echo "<script>alert('Cliente excluído com sucesso!');</script>";
            // Redirecionar para a página de administração após a exclusão
            header("Location: login.php");
        } else {
            echo "Erro ao excluir cliente: " . mysqli_error($conn);
        }
    } else {
        echo "cliente não encontrado.";
    }

    mysqli_close($conn);
} else {
    echo "ID do cliente não fornecido.";
}
?>
