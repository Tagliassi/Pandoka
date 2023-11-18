<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto - Panificadora Pandoka</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 50px;
            background-color: #ff444b;
            color: black;
            font-size: 20px;
        }
        form{
            background-color: white;
            width: 40%;
            margin-left: 28%;
            margin-top: 100px;
        }
        table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        border: 2px solid black; /* Define a cor da borda da tabela como preto */
    }

    table th,
    table td {
        border: 1px solid black; /* Define a cor das bordas das células como preto */
        padding: 8px;
        text-align: left;
    }

    table th {
        background-color: #f2f2f2;
    }

        h2 {
            text-align: center;
        }

        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
        }

        input[type="submit"], input[type="button"] {
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

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
    session_start();

    if (!isset($_SESSION['id_funcionario'])) {
        header("Location: ../../Front-End/HTML/Sign_And_Login/login.php");
        exit();
    }

    require '../../Back-End/PHP/conectaBD.php'; // Caminho para o arquivo de conexão com o banco de dados

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['produto_id'])) {
            $produto_id = $_POST['produto_id'];

            $sql = "SELECT * FROM Produtos WHERE id_produto = $produto_id";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $produto = mysqli_fetch_assoc($result);
                // Formulário para edição do produto
                ?>
                <h2>Editar Produto</h2>
                <form action="atualiza_produto.php" method="post">
    <input type="hidden" name="produto_id" value="<?php echo $produto['id_produto']; ?>">
    <table>
        <tr>
            <td>Nome do Produto:</td>
            <td><input type="text" name="nome" value="<?php echo $produto['nome']; ?>"></td>
        </tr>
        <tr>
            <td>Valor Unitário:</td>
            <td><input type="text" name="valor" value="<?php echo $produto['valor']; ?>"></td>
        </tr>
        <tr>
            <td>Disponibilidade:</td>
            <td><input type="text" name="disponibilidade" value="<?php echo $produto['disponibilidade']; ?>"></td>
        </tr>
        <tr>
            <td>Quantidade em Estoque:</td>
            <td><input type="text" name="quantidade_estoque" value="<?php echo $produto['quantidade_estoque']; ?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Salvar Alterações">
                <!-- Botão para deletar o produto -->
                <input type="button" value="Deletar Produto" onclick="confirmarExclusao(<?php echo $produto['id_produto']; ?>)">
            </td>
        </tr>
    </table>
</form>
                <script>
                    function confirmarExclusao(produtoId) {
                        if (confirm("Tem certeza que deseja excluir este produto?")) {
                            window.location.href = "deleta_produto.php?produto_id=" + produtoId;
                        }
                    }
                </script>
                <?php
            } else {
                echo "Erro ao buscar informações do produto: " . mysqli_error($conn);
            }
        }
    }

    mysqli_close($conn);
?>
    
</body>
</html>
