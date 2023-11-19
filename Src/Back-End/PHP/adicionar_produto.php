<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Novo Produto - Panificadora Pandoka</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 50px;
            background-color: #ff444b;
            color: black;
            font-size: 20px;
        }

        form {
            background-color: white;
            width: 40%;
            margin-left: 30%; /* Ajustando um pouco o posicionamento horizontal */
            margin-top: 100px;
            padding: 20px; /* Adicionando um pouco de espaçamento interno */
            border-radius: 8px; /* Adicionando bordas arredondadas */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Adicionando uma sombra sutil */
        }

        h2 {
            text-align: center;
        }

        input[type="text"],
        input[type="number"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
            border: 1px solid #ccc; /* Adicionando uma borda cinza */
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin-top: 5px;
            cursor: pointer;
            border-radius: 3px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

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

    // Captura dos dados do formulário
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $disponibilidade = $_POST['disponibilidade'];
    $categoria = $_POST['fk_Categoria_id_categoria'];

    // Prepara a consulta SQL para adicionar um novo produto
    $sql = "INSERT INTO Produtos (nome, valor, quantidade_estoque, disponibilidade, fk_Categoria_id_categoria) VALUES ('$nome', '$valor', '$quantidade_estoque', '$disponibilidade', '$categoria')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Novo produto adicionado com sucesso!');</script>";
        header("Location: ./catalogo_produtos_funcionario.php");
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
