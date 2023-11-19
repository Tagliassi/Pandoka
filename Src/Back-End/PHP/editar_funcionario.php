<?php
require './conectaBD.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_funcionario = $_GET['id'];

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM Funcionarios WHERE id_funcionario = $id_funcionario";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $funcionario = mysqli_fetch_assoc($result);
    } else {
        echo "Funcionário não encontrado.";
        exit();
    }

    mysqli_close($conn);
} else {
    echo "ID do funcionário não fornecido.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar Funcionário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
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
        input[type="date"] {
            width: calc(100% - 22px);
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
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

<h1>Editar Funcionário</h1>

<form method="post" action="atualiza_funcionario.php">
    <input type="hidden" name="id_funcionario" value="<?php echo $funcionario['id_funcionario']; ?>">

    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" value="<?php echo $funcionario['nome']; ?>"><br>

    <label for="data_nascimento">Data de Nascimento:</label><br>
    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $funcionario['data_nascimento']; ?>"><br>

    <label for="salario">Salário:</label><br>
    <input type="text" id="salario" name="salario" value="<?php echo $funcionario['salario']; ?>"><br>

    <input type="submit" value="Salvar Alterações">
</form>

</body>
</html>

