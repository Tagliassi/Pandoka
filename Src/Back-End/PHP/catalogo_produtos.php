<!DOCTYPE html>
<html>
<head>
    <title>Panificadora Pandoka</title>
</head>
<body>

    <!-- Verificação do login do cliente -->
    <?php
        session_start();

        if (!isset($_SESSION['id_cliente'])) {
            // Se o cliente não estiver logado, redirecione para a página de login
            header("Location: ../../Front-End/HTML/Sign_And_Login/login.php");
            exit();
        }

        $id_cliente = $_SESSION['id_cliente'];

        // Inclui arquivos necessários após a verificação do login
        require '../../Front-End/HTML/Pagina_Principal/pagina_cliente.php';
        require '../../Back-End/PHP/conectaBD.php';

        // Cria conexão
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Verifica conexão 
        if (!$conn) {
            echo "</table>";
            echo "</div>";
            die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
        }

        // Faz Select na Base de Dados
        $sql = "SELECT id_produto, nome, valor, disponibilidade, quantidade_estoque FROM Produtos";

        // Cria Catálogo de Produtos
        if ($result = mysqli_query($conn, $sql)) {

            // Cabeçalho da tabela
            echo "<table class='Catalogo'>";
            echo "<tr>";
            echo "<th width='5%'>Código</th>";
            echo "<th width='20%'>Nome do Produto</th>";
            echo "<th width='15%'>Valor Unitário</th>";
            echo "<th width='15%'>Disponibilidade</th>";
            echo "<th width='20%'>Quantidade em Estoque</th>";
            echo "<th width='5%'>Carrinho</th>";
            echo "</tr>";

            if (mysqli_num_rows($result) > 0) {
                
                // Apresenta cada linha da tabela
                while ($row = mysqli_fetch_assoc($result)) {
                    $codigo = $row["id_produto"];
                    $valor_unitario = number_format($row['valor'], 2, ',', '.'); 
                
                    echo "<tr>";
                    echo "<td>{$codigo}</td>";
                    echo "<td>{$row['nome']}</td>"; 
                    echo "<td>R$ {$valor_unitario}</td>";
                    echo "<td>{$row['disponibilidade']}</td>";
                    echo "<td>{$row['quantidade_estoque']} unidades</td>";
                    echo "<td>";
                
                    // Verificação da disponibilidade do produto
                    if ($row['disponibilidade'] == true && $row['quantidade_estoque'] > 0) {
                        // Formulário para adicionar ao carrinho
                        echo "<form action='../../Back-End/PHP/carrinho_compras.php' method='post'>";
                        echo "<input type='hidden' name='produto_id' value='{$codigo}'>";
                        echo "<input type='hidden' name='id_cliente' value='{$id_cliente}'>";
                        echo "<input type='number' name='quantidade' min='1' max='{$row['quantidade_estoque']}' placeholder='Quantidade' required>";
                        echo "<input type='submit' value='Adicionar ao Carrinho'>";
                        echo "</form>";

                    } else {
                        echo "Produto Indisponível"; 
                    }
                
                    echo "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";
            echo "</div>";

        } else {
            echo "Erro executando SELECT: " . mysqli_error($conn);
        }

        // Fecha a conexão com o BD
        mysqli_close($conn);

    ?>

</body>
</html>
