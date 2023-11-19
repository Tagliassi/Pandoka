<?php
session_start();

if (!isset($_SESSION['id_funcionario'])) {
    header("Location: ./login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require './conectaBD.php'; // Caminho para o arquivo de conexão com o banco de dados

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    $produto_id = $_POST['produto_id'];
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $disponibilidade = $_POST['disponibilidade'];
    $quantidade_estoque = $_POST['quantidade_estoque'];

    // Prepara a consulta SQL para atualizar os dados do produto
    $sql = "UPDATE Produtos SET nome = '$nome', valor = '$valor', disponibilidade = '$disponibilidade', quantidade_estoque = '$quantidade_estoque' WHERE id_produto = $produto_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Dados do produto atualizados com sucesso!');</script>";
        header("Location: ./catalogo_produtos_funcionario.php");
    } else {
        echo "Erro ao atualizar dados do produto: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: ./login.php");
    exit();
}
?>
