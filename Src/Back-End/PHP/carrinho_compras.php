<!DOCTYPE html>
<html>

<head>
    <title>Panificadora Pandoka</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Inclusão de estilos CSS externos -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>

<body onload="w3_show_nav('menuMedico')">
    <!-- Inclusão do menu e conexão com o banco de dados -->
    <?php require '../../Front-End/HTML/Pagina_Principal/menu.php'; ?>
    <?php require '../../Back-End/PHP/conectaBD.php'; ?>

    <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
    <div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <p class="w3-large">
                <p>
                    <div class="w3-code cssHigh notranslate">
                        <!-- Informações sobre o acesso à página -->
                        <?php
                        date_default_timezone_set("America/Sao_Paulo");
                        $data = date("d/m/Y H:i:s", time());
                        echo "<p class='w3-small' > ";
                        echo "Acesso em: ";
                        echo $data;
                        echo "</p> "
                        ?>
                        <!-- Título da página -->
                        <div class="w3-container w3-theme">
                            <h2>Carrinho de Compras</h2>
                        </div>

                        <!-- Acesso ao BD -->
                        <?php
                        // Cria conexão
                        $conn = mysqli_connect($servername, $username, $password, $database);

                        // Verifica conexão 
                        if (!$conn) {
                            echo "</div>";
                            die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
                        }

                        // Configura para trabalhar com caracteres acentuados do português
                        mysqli_query($conn, "SET NAMES 'utf8'");
                        mysqli_query($conn, 'SET character_set_connection=utf8');
                        mysqli_query($conn, 'SET character_set_client=utf8');
                        mysqli_query($conn, 'SET character_set_results=utf8');

                        // Faz Inserts no banco de dados
                        
                        // Verifica se os dados do formulário foram enviados via POST
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_produto"], $_POST["id_cliente"], $_POST["quantidade"])) {
                            $id_cliente = $_POST["id_cliente"];
                            $id_produto = $_POST["id_produto"];
                            $quantidade = $_POST["quantidade"];
                        
                            if (empty($id_cliente) || empty($id_produto) || empty($quantidade) || $quantidade <= 0) {
                                echo "Por favor, preencha todos os campos corretamente.";
                            } else {
                                // Aqui, utilize prepared statements para evitar SQL Injection
                                $sql_check_availability = "SELECT quantidade_estoque FROM Produtos WHERE id_produto = ?";
                                $stmt = $conn->prepare($sql_check_availability);
                                $stmt->bind_param("i", $id_produto);
                                $stmt->execute();
                                $result_check_availability = $stmt->get_result();
                        
                                if ($result_check_availability->num_rows > 0) {
                                    $row = $result_check_availability->fetch_assoc();
                                    $estoque_disponivel = $row["quantidade_estoque"];
                        
                                    if ($quantidade <= $estoque_disponivel) {
                                        $sql_inserir_pedido = "INSERT INTO Pedidos (data_realizacao, fk_Clientes_id_cliente, fk_Funcionarios_id_funcionario) VALUES (CURDATE(), ?, ?)";
                                        $stmt = $conn->prepare($sql_inserir_pedido);
                                        $stmt->bind_param("ii", $id_cliente, $id_funcionario_logado);
                                        if ($stmt->execute()) {
                                            $ultimo_id_pedido = $stmt->insert_id;
                        
                                            $sql_inserir_item_pedido = "INSERT INTO ItensPedido (fk_Produtos_id_produto, fk_Pedidos_id_pedido, quantidade) VALUES (?, ?, ?)";
                                            $stmt = $conn->prepare($sql_inserir_item_pedido);
                                            $stmt->bind_param("iii", $id_produto, $ultimo_id_pedido, $quantidade);
                                            if ($stmt->execute()) {
                                                $nova_quantidade_estoque = $estoque_disponivel - $quantidade;
                                                $sql_atualizar_estoque = "UPDATE Produtos SET quantidade_estoque = ? WHERE id_produto = ?";
                                                $stmt = $conn->prepare($sql_atualizar_estoque);
                                                $stmt->bind_param("ii", $nova_quantidade_estoque, $id_produto);
                                                if ($stmt->execute()) {
                                                    echo "Pedido processado com sucesso.";
                                                } else {
                                                    echo "Erro ao atualizar o estoque: " . $stmt->error;
                                                }
                                            } else {
                                                echo "Erro ao inserir o item do pedido: " . $stmt->error;
                                            }
                                        } else {
                                            echo "Erro ao inserir o pedido: " . $stmt->error;
                                        }
                                    } else {
                                        echo "Quantidade solicitada indisponível em estoque.";
                                    }
                                } else {
                                    echo "Produto não encontrado.";
                                }
                            }
                        } else {
                            echo "Dados não estão definidos ou não foram recebidos.";
                        }
                        
                        $sql = "SELECT Id_itensPedido AS `Código`, fk_Produtos_id_produto AS `Código Produto`, fk_Pedidos_id_pedido AS `Código Pedido`, quantidade AS Quantidade FROM ItensPedido";

                        echo "<div class='w3-responsive w3-card-4'>";
                        if ($result = mysqli_query($conn, $sql)) {
                            // Cabeçalho da tabela
                            echo "<table class='w3-table-all'>";
                            echo "<tr>";
                            echo "<th width='5%'>Código</th>"; 
                            echo "<th width='20%'>Código Produto</th>";
                            echo "<th width='15%'>Código Pedido</th>";
                            echo "<th width='20%'>Quantidade</th>";
                            echo "<th width='20%'>Subtotal</th>"; // quantidade de produtos comprados * valor unitario;
                            echo "<th width='20%'>Excluir</th>";
                            echo "</tr>";

                            if (mysqli_num_rows($result) > 0) {
                                // Apresenta cada linha da tabela
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $codigo = $row["Id_itensPedido"];
                                    $codigo_produto = $row["fk_Produtos_id_produto"];
                                    $codigo_pedido = $row["fk_Pedidos_id_pedido"];
                                    $quantidade = $row["quantidade"];

                                    // Exibir os itens no carrinho
                                    echo "<tr>";
                                    echo "<td>{$codigo}</td>";
                                    echo "<td>{$codigo_produto}</td>";
                                    echo "<td>{$codigo_pedido}</td>";
                                    echo "<td>{$quantidade} unidades</td>";
                                    echo "<td>Subtotal (a ser implementado)</td>";
                                    echo "<td>Excluir do carrinho</td>";
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
                        
                    </div>
            </p>
        </div>

        <!-- Inclusão do modal "Sobre" -->
        <?php require '../../Front-End/HTML/Pagina_Principal/comprar.php'; ?>
        <!-- FIM PRINCIPAL -->
    </div>
    <!-- Inclui RODAPE.PHP  -->
    <?php require '../../Front-End/HTML/Pagina_Principal/confirmar_compra.php'; ?>

</body>

</html>
