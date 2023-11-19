<?php
// Incluir arquivo de conexão com o banco de dados
require './conectaBD.php';

$conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
    }

    mysqli_query($conn,"SET NAMES 'utf8'");
    mysqli_query($conn,'SET character_set_connection=utf8');
    mysqli_query($conn,'SET character_set_client=utf8');
    mysqli_query($conn,'SET character_set_results=utf8');

// Função para buscar e exibir informações dos funcionários
function exibirFuncionarios() {
    global $conn;

    $sql = "SELECT * FROM Funcionarios";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>Data de Nascimento</th><th>Data de Admissão</th><th>Salário</th><th>Ação</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_funcionario"] . "</td>";
            echo "<td width='30%'>" . $row["nome"] . "</td>";
            echo "<td>" . $row["data_nascimento"] . "</td>";
            echo "<td>" . $row["data_admissao"] . "</td>";
            echo "<td>" . $row["salario"] . "</td>";
            echo "<td width='20%'>";
            echo "<a href='editar_funcionario.php?id=" . $row['id_funcionario'] . "'>Editar</a> | ";
            echo "<a href='excluir_funcionario.php?id=" . $row['id_funcionario'] . "'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum funcionário encontrado.";
    }
}

// Se o método for POST, significa que um funcionário foi excluído
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_excluir'])) {
    $id_excluir = $_POST['id_excluir'];
    $sql_delete = "DELETE FROM Funcionarios WHERE id_funcionario = $id_excluir";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('Funcionário excluído com sucesso!');</script>";
        // Recarregar a página ou redirecionar após a exclusão
        header("Refresh:0");
    } else {
        echo "Erro ao excluir funcionário: " . mysqli_error($conn);
    }
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once './conectaBD.php';
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Verificar a conexão
    if (!$conn) {
        die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
    }

    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $salario = $_POST['salario'];

    // Validar e formatar os dados, executar a consulta SQL para inserção no banco de dados
    $query = "INSERT INTO Funcionarios (nome, data_nascimento, data_admissao, salario) 
              VALUES ('$nome', '$data_nascimento', NOW(), '$salario')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Cadastro de funcionário realizado com sucesso!');</script>";
    } else {
        echo "Erro ao cadastrar funcionário: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página de Administração</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            justify-content: center;
            width: 100%;
            margin: 60px auto;
        }

        .lista-funcionarios,
        .cadastro-funcionario {
            width: 40%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 10px;
            overflow: auto;
        }

        .lista-funcionarios{
            width: 50%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        /* Restante dos estilos existentes */

        form label,
        form input {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form input[type="date"] {
            width: calc(100% - 22px);
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #000;
        }

        .sair {
            text-align: center;
            margin-top: 0px;
            margin-bottom: 60px;
        }

        .sair a {
            text-decoration: none;
            padding: 8px 16px;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sair a:hover {
            background-color: #000;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Seção da lista de funcionários -->
    <div class="lista-funcionarios">
        <h1>Lista de Funcionários</h1>
        <?php exibirFuncionarios(); ?>
    </div>

    <!-- Seção de cadastro de funcionários -->
    <div class="cadastro-funcionario">
        <h1>Cadastro de Funcionários</h1>
        <form method="post" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento">

            <label for="salario">Salário:</label>
            <input type="text" id="salario" name="salario">

            <input type="submit" value="Cadastrar Funcionário">
        </form>
    </div>
</div>

<div class="sair">
    <a href="login.php">Sair</a>
</div>

</body>
</html>

<?php
// Fechar a conexão
    mysqli_close($conn);
?>
