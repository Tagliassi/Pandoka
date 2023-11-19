<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Panificadora Online</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('../IMGS/gif.gif') center center no-repeat;
            background-size: cover;
            animation: animatedBackground 20s ease infinite;
        }

        form {
            width: 90%;
            max-width: 400px;
            padding: 30px;
            border-radius: 10px;
            background-color: rgba(255, 92, 97, 0.9); /* Cor vermelha com 70% de opacidade */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }



        label {
            font-weight: bold;
            color: #333333;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            margin: 8px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #000000;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #333333;
        }

        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            background-color: #000000;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            height: 20px;
        }

        a:hover {
            background-color: #333333;
        }

        @media screen and (max-width: 480px) {
            form {
                padding: 20px;
            }
        }
        @keyframes animatedBackground {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

    </style>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once './conectaBD.php';
        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
        }

        mysqli_query($conn,"SET NAMES 'utf8'");
        mysqli_query($conn,'SET character_set_connection=utf8');
        mysqli_query($conn,'SET character_set_client=utf8');
        mysqli_query($conn,'SET character_set_results=utf8');

        $tipo_usuario = $_POST['tipo_usuario'];
        $nome = $_POST['nome'];

        if (!preg_match("/^[a-zA-ZÀ-ú\s]*$/", $nome)) {
            echo "Nome inválido. O nome deve conter apenas letras.";
            exit();
        }

        if ($tipo_usuario === 'cliente') {
            $cpf = $_POST['cpf'];

            if (strlen($cpf) !== 11 || !is_numeric($cpf)) {
                echo "CPF inválido. O CPF deve conter 11 números.";
                exit();
            }

            $query = "INSERT INTO Clientes (nome, cpf) VALUES ('$nome', '$cpf')";

        } else if ($tipo_usuario === 'funcionario') {
            $data_nascimento = $_POST['data_nascimento'];

            if (!strtotime($data_nascimento)) {
                echo "Data de nascimento inválida. Use o formato YYYY-MM-DD.";
                exit();
            }

            if (strtotime($data_nascimento) >= strtotime(date('Y-m-d'))) {
                echo "Data de nascimento inválida. Deve ser anterior à data atual.";
                exit();
            }

            $salario = $_POST['salario'];

            if (!is_numeric($salario) || $salario <= 0) {
                echo "Salário inválido. Insira um valor numérico positivo.";
                exit();
            }

            $query = "INSERT INTO Funcionarios (nome, data_nascimento, data_admissao, salario) 
                      VALUES ('$nome', '$data_nascimento', NOW(), '$salario')";

        } else {
            echo "Tipo de usuário inválido!";
            exit();
        }

        if ($conn->query($query) === TRUE) {
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    }
    ?>
<form method="post" action="">
        <label for="tipo_usuario">Selecione o tipo de usuário:</label><br>
        <select name="tipo_usuario" id="tipo_usuario">
            <option value="cliente">Cliente</option>
            <option value="funcionario">Funcionário</option>
        </select><br>

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>

        <!-- campo CPF para clientes -->
        <div id="campos_cpf">
            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf"><br>
        </div>

        <!-- campos específicos para funcionários -->
        <div id="campos_funcionario" style="display: none;">
            <label for="data_nascimento">Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento"><br>

            <label for="salario">Salário:</label><br>
            <input type="text" id="salario" name="salario"><br>
        </div>

        <input type="submit" value="Cadastrar">
        <a href="./login.php">Já tem cadastro? Faça login aqui</a>
    </form>

    <!-- Link para a página de login -->
   

    <script>
        var tipoUsuarioSelect = document.getElementById("tipo_usuario");
        var camposCpf = document.getElementById("campos_cpf");
        var camposFuncionario = document.getElementById("campos_funcionario");

        tipoUsuarioSelect.addEventListener("change", function() {
            if (tipoUsuarioSelect.value === "funcionario") {
                camposCpf.style.display = "none";
                camposFuncionario.style.display = "block";
            } else if (tipoUsuarioSelect.value === "cliente") {
                camposCpf.style.display = "block";
                camposFuncionario.style.display = "none";
            }
        });
    </script>
</body>
</html>