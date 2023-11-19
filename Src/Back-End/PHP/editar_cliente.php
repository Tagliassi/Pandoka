<?php
require './conectaBD.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM clientes WHERE id_cliente = $id_cliente";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $cliente = mysqli_fetch_assoc($result);
    } else {
        echo "Cliente não encontrado.";
        exit();
    }

    mysqli_close($conn);
} else {
    echo "ID do cliente não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to right, #ff444b, #ff5c61);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="int"] {
        width: calc(100% - 22px);
        padding: 5px;
        border-radius: 5px;
        border: 2px solid #000; 
        margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #000;
        }
    </style>
</head>
<body>

<h1>Editar Cliente</h1>

<form method="post" action="atualiza_cliente.php">
    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">

    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>"><br>

    <label for="cpf">CPF:</label><br>
    <input type="text" id="cpf" name="cpf" value="<?php echo $cliente['cpf']; ?>"><br>

    <label for="data">Data Nascimento:</label><br>
    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $cliente['data_nascimento']; ?>"><br>

    <label for="rua">Rua:</label><br>
    <input type="text" id="rua" name="rua" value="<?php echo $cliente['rua']; ?>"><br>    
    
    <label for="numero">Numero:</label><br>
    <input type="int" id="numero" name="numero" value="<?php echo $cliente['numero']; ?>"><br>   
    
    <label for="bairro">Bairro:</label><br>
    <input type="text" id="bairro" name="bairro" value="<?php echo $cliente['bairro']; ?>"><br>    
    
    <label for="cidade">Cidade:</label><br>
    <input type="text" id="cidade" name="cidade" value="<?php echo $cliente['cidade']; ?>"><br>    

    <label for="cep">CEP:</label><br>
    <input type="text" id="cep" name="cep" value="<?php echo $cliente['cep']; ?>"><br>  
    
    <input type="submit" value="Salvar Alterações">
</form>

</body>
</html>

