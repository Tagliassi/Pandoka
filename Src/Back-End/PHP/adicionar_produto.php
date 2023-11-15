<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Novo Produto - Panificadora Pandoka</title>
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['id_funcionario'])) {
    header("Location: ../../Front-End/HTML/Sign_And_Login/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../../Back-End/PHP/conectaBD.php'; // Caminho para o arquivo de conexão com o banco de dados

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    // Captura dos dados do formulário
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $disponibilidade = $_POST['disponibilidade'];
    $categoria = $_POST['fk_Categoria_id_categoria'];

    // Prepara a consulta SQL para adicionar um novo produto
    $sql = "INSERT INTO Produtos (nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria) VALUES ('$nome', '$valor', '$quantidade_estoque', '$disponibilidade', '$categoria')";

    if (mysqli_query($conn, $sql)) {
        echo "Novo produto adicionado com sucesso!";
        header("Location: ../../Back-End/PHP/catalogo_produtos_funcionario.php");
    } else {
        echo "Erro ao adicionar novo produto: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<h2>Adicionar Novo Produto</h2>
<form action="" method="post">
    Nome do Produto: <input type="text" name="nome" required><br>
    Valor Unitário: <input type="text" name="valor" required><br>
    Quantidade em Estoque: <input type="number" name="quantidade_estoque" required><br>
    Disponibilidade: <input type="text" name="disponibilidade" required><br>
    Categoria: <input type="number" name="fk_Categoria_id_categoria" required><br>
    <input type="submit" value="Adicionar Produto">
</form>
    
</body>
</html>
