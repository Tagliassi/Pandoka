<?php
require_once '../../../Back-End/PHP/conectaBD.php';

// Cria conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica conexão
if (!$conn) {
    die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
}

// Configura para trabalhar com caracteres acentuados do português
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_usuario = $_POST['tipo_usuario'];
    $nome = $_POST['nome'];

    // Verifica se o nome contém apenas letras
    if (!preg_match("/^[a-zA-ZÀ-ú\s]*$/", $nome)) {
        echo "Nome inválido. O nome deve conter apenas letras.";
        exit();
    }

    if ($tipo_usuario === 'cliente') {
        $cpf = $_POST['cpf'];

        // Validar CPF 
        if (strlen($cpf) !== 11 || !is_numeric($cpf)) {
            echo "CPF inválido. O CPF deve conter 11 números.";
            exit();
        }

        $query = "INSERT INTO Clientes (nome, cpf) VALUES ('$nome', '$cpf')";

    } else if ($tipo_usuario === 'funcionario') {
        $data_nascimento = $_POST['data_nascimento'];

        // Verifica se a data de nascimento é válida (formato YYYY-MM-DD)
        if (!strtotime($data_nascimento)) {
            echo "Data de nascimento inválida. Use o formato YYYY-MM-DD.";
            exit();
        }

        // Validar se a data é anterior à data atual
        if (strtotime($data_nascimento) >= strtotime(date('Y-m-d'))) {
            echo "Data de nascimento inválida. Deve ser anterior à data atual.";
            exit();
        }

        $salario = $_POST['salario'];

        // Verifica se o salário é um número positivo
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
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}
?>

<!-- Formulário de Cadastro -->
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
</form>

<!-- Link para a página de login -->
<a href="./login.php">Login</a>

<script>
    // Obter o elemento select do tipo de usuário
    var tipoUsuarioSelect = document.getElementById("tipo_usuario");

    // Obter os elementos dos campos de CPF e funcionário
    var camposCpf = document.getElementById("campos_cpf");
    var camposFuncionario = document.getElementById("campos_funcionario");

    // Adicionar um evento de mudança ao seletor de tipo de usuário
    tipoUsuarioSelect.addEventListener("change", function() {
        if (tipoUsuarioSelect.value === "funcionario") {
            // Se for funcionário, esconder o campo de CPF e mostrar os campos de funcionário
            camposCpf.style.display = "none";
            camposFuncionario.style.display = "block";
        } else if (tipoUsuarioSelect.value === "cliente") {
            // Se for cliente, mostrar o campo de CPF e esconder os campos de funcionário
            camposCpf.style.display = "block";
            camposFuncionario.style.display = "none";
        }
    });
    
</script>



