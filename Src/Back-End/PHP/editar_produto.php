<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto - Panificadora Pandoka</title>
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
                    Nome do Produto: <input type="text" name="nome" value="<?php echo $produto['nome']; ?>"><br>
                    Valor Unitário: <input type="text" name="valor" value="<?php echo $produto['valor']; ?>"><br>
                    Disponibilidade: <input type="text" name="disponibilidade" value="<?php echo $produto['disponibilidade']; ?>"><br>
                    Quantidade em Estoque: <input type="text" name="quantidade_estoque" value="<?php echo $produto['quantidade_estoque']; ?>"><br>
                    <input type="submit" value="Salvar Alterações">
                    <!-- Botão para deletar o produto -->
                    <input type="button" value="Deletar Produto" onclick="confirmarExclusao(<?php echo $produto['id_produto']; ?>)">
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
