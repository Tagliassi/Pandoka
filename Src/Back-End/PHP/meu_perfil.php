<?php
session_start();

// Incluir arquivo de conexão com o banco de dados
require './conectaBD.php';

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
}

if (!isset($_SESSION['id_cliente'])) {
    // Se o cliente não estiver logado, redirecione para a página de login
    header("Location: ./login.php");
    exit();
}
    
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');

// Função para buscar e exibir informações dos clientes
function exibirCliente() {
    global $conn;

    $id_cliente = $_SESSION['id_cliente'];

    $sql = "SELECT * FROM Clientes WHERE id_cliente = $id_cliente";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>CPF</th><th>Data de Nascimento</th><th>CEP</th><th>Logradouro</th><th>Numero</th><th>Bairro</th><th>Cidade</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_cliente"] . "</td>";
            echo "<td>" . $row["nome"] . "</td>";

            $cpf = $row["cpf"];
            $cpf_formatado = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
            echo "<td>" . $cpf_formatado . "</td>";

            $data_nascimento = $row["data_nascimento"];
            $data_formatada = date('d/m/Y', strtotime($data_nascimento));
            echo "<td>" . $data_formatada . "</td>";

            $cep = $row["cep"];
            $cep_formatado = preg_replace('/^(\d{5})(\d{3})$/', '$1-$2', $cep);
            echo "<td>" . $cep_formatado . "</td>";

            echo "<td>" . $row["rua"] . "</td>";
            echo "<td>" . $row["numero"] . "</td>";
            echo "<td>" . $row["bairro"] . "</td>";
            echo "<td>" . $row["cidade"] . "</td>";
            echo "<td width='20%'>";
            echo "<a class='button-link edit-button' href='editar_cliente.php?id=" . $row['id_cliente'] . "'>Editar</a> | ";
            echo "<a class='button-link delete-button' href='excluir_cliente.php?id=" . $row['id_cliente'] . "'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum cliente encontrado.";
    }
}

// Se o método for POST, significa que um funcionário foi excluído
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_excluir'])) {
    $id_excluir = $_POST['id_excluir'];
    $sql_delete = "DELETE FROM Clientes WHERE id_cliente = $id_excluir";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('Cliente excluído com sucesso!');</script>";
        // Recarregar a página ou redirecionar após a exclusão
        header("Refresh:0");
    } else {
        echo "Erro ao excluir cliente: " . mysqli_error($conn);
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
            background: linear-gradient(to right, #ff444b, #ff5c61);
            align-itens: center;
        }

        .container {
            display: flex;
            justify-content: center;
            width: 100vw;
            margin: 30px auto;
        }

        .lista-funcionarios,
        .cadastro-funcionario {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 10px;
            overflow: auto;
        }

        .lista-funcionarios{
            width: 100%;
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

       .button-link {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .edit-button {
            background-color: #4CAF50; 
            color: white; 
        }

        .delete-button {
            background-color: #ff444b;
            color: white; 
        }

        .button-link:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Seção da lista de funcionários -->
    <div class="lista-funcionarios">
        <h1>Meu Perfil</h1>
        <?php exibirCliente(); ?>
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
