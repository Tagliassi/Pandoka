<!DOCTYPE html>
<html>
<head>
    <title>Finalizar Compra</title>
    <style>
        form {
            text-align: center; /* Alinhar o conteúdo no centro */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white; 
            padding: 10px 15px; 
            font-size: 16px; 
            border: none;
            border-radius: 5px; 
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049; 
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px; /* Reduzindo o espaçamento para melhorar a aparência */
            background-color: #ff444b;
            color: white; /* Mudando a cor do texto para branco */
            font-size: 18px; /* Diminuindo um pouco o tamanho da fonte */
        }

        h1 {
            text-align: center; /* Centralizando o título */
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilo para a mensagem de sucesso */
        .success-message {
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
// Verifica se o método é POST e se o campo pedido_id está definido no formulário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pedido_id'])) {
    $pedido_id = $_POST['pedido_id'];

    // Inclua o arquivo de conexão com o banco de dados
    require_once 'conectaBD.php'; // Certifique-se de substituir pelo caminho correto do seu arquivo

    // Conecta ao banco de dados (substitua pelas suas credenciais)
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Verifica a conexão com o banco de dados
    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    // Prepara e executa a chamada da procedure
    $sql = "CALL ObterDetalhesPedido($pedido_id)";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<table border='1'>";
        do {
            // Armazena os resultados da query
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) { 
                    if (array_key_exists('subtotal', $row)) {
                        echo "<script>alert('Compra realizada com sucesso!\\n\\nSubtotal: {$row['subtotal']}');</script>";
                    } else {
                        header("refresh:0; url=catalogo_produtos.php");
                    }
                }
                
            }
        } while (mysqli_next_result($conn)); // Avança para o próximo resultado (se houver)
        

        echo "</table>";
    } else {
        echo "Erro ao executar a procedure: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Fecha a conexão com o banco de dados
} else {
    echo "ID do pedido não fornecido ou método inválido.";
}
?>
</body>
</html>
