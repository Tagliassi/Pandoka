<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_cliente'])) {
    require '../../Back-End/PHP/conectaBD.php'; // Caminho para o arquivo de conexão com o banco de dados

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    // Recebe os dados do formulário
    $id_cliente = $_SESSION['id_cliente'];
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Evita SQL Injection
    $id_cliente = mysqli_real_escape_string($conn, $id_cliente);
    $produto_id = mysqli_real_escape_string($conn, $produto_id);
    $quantidade = mysqli_real_escape_string($conn, $quantidade);

    // Verifica se existe um pedido em aberto para o cliente
    $sql_check_pedido = "SELECT id_pedido FROM Pedidos WHERE fk_Clientes_id_cliente = '$id_cliente' AND data_realizacao IS NULL";
    $result_check_pedido = mysqli_query($conn, $sql_check_pedido);

    if (mysqli_num_rows($result_check_pedido) > 0) {
        // Se houver um pedido em aberto para o cliente, adiciona o item ao pedido existente
        $row_pedido = mysqli_fetch_assoc($result_check_pedido);
        $pedido_id = $row_pedido['id_pedido'];

        // Verifica se o item já está no pedido
        $sql_check_item = "SELECT * FROM ItensPedido WHERE fk_Pedidos_id_pedido = '$pedido_id' AND fk_Produtos_id_produto = '$produto_id'";
        $result_check_item = mysqli_query($conn, $sql_check_item);

        if (mysqli_num_rows($result_check_item) > 0) {
            // Atualiza a quantidade do item no pedido
            $row_item = mysqli_fetch_assoc($result_check_item);
            $nova_quantidade = $row_item['quantidade'] + $quantidade;

            $sql_update_item = "UPDATE ItensPedido SET quantidade = '$nova_quantidade' WHERE fk_Pedidos_id_pedido = '$pedido_id' AND fk_Produtos_id_produto = '$produto_id'";
            if (mysqli_query($conn, $sql_update_item)) {
                echo "Quantidade atualizada no pedido com sucesso!";
            } else {
                echo "Erro ao atualizar quantidade no pedido: " . mysqli_error($conn);
            }
        } else {
            // Insere um novo item no pedido
            $sql_insert_item = "INSERT INTO ItensPedido (fk_Pedidos_id_pedido, fk_Produtos_id_produto, quantidade) VALUES ('$pedido_id', '$produto_id', '$quantidade')";
            if (mysqli_query($conn, $sql_insert_item)) {
                echo "Produto adicionado ao pedido com sucesso!";
            } else {
                echo "Erro ao adicionar produto ao pedido: " . mysqli_error($conn);
            }
        }
    } else {
        // Se não houver um pedido em aberto para o cliente, cria um novo pedido e adiciona o item ao pedido
        $sql_create_pedido = "INSERT INTO Pedidos (fk_Clientes_id_cliente, data_realizacao) VALUES ('$id_cliente', NOW())";
        if (mysqli_query($conn, $sql_create_pedido)) {
            $pedido_id = mysqli_insert_id($conn); // Obtém o ID do novo pedido criado

            // Insere um novo item no pedido
            $sql_insert_item = "INSERT INTO ItensPedido (fk_Pedidos_id_pedido, fk_Produtos_id_produto, quantidade) VALUES ('$pedido_id', '$produto_id', '$quantidade')";
            if (mysqli_query($conn, $sql_insert_item)) {
                echo "Produto adicionado ao novo pedido com sucesso!";
            } else {
                echo "Erro ao adicionar produto ao pedido: " . mysqli_error($conn);
            }
        } else {
            echo "Erro ao criar novo pedido: " . mysqli_error($conn);
        }
    }
} else {
    echo "Erro: Não autorizado ou método de requisição inválido.";
}

// Consulta para recuperar os pedidos e seus itens associados ao cliente, incluindo a data de realização
$sql_pedidos = "SELECT Pedidos.id_pedido, Pedidos.data_realizacao, Produtos.nome AS nome_produto, ItensPedido.quantidade
                FROM Pedidos
                INNER JOIN ItensPedido ON Pedidos.id_pedido = ItensPedido.fk_Pedidos_id_pedido
                INNER JOIN Produtos ON ItensPedido.fk_Produtos_id_produto = Produtos.id_produto
                WHERE Pedidos.fk_Clientes_id_cliente = '$id_cliente'";

$result_pedidos = mysqli_query($conn, $sql_pedidos);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seu Carrinho de Compras</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Seu Carrinho de Compras</h2>

<?php
if (mysqli_num_rows($result_pedidos) > 0) {
    echo "<table>";
    echo "<tr><th>ID do Pedido</th><th>Nome do Produto</th><th>Quantidade</th></tr>";
    while ($row = mysqli_fetch_assoc($result_pedidos)) {
        echo "<tr>";
        echo "<td>" . $row["id_pedido"] . "</td>";
        echo "<td>" . $row["nome_produto"] . "</td>";
        echo "<td>" . $row["quantidade"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Não há itens no seu carrinho de compras.";
}

mysqli_close($conn);
?>
