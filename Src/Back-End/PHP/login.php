<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Panificadora Online</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('./../IMGS/gif.gif') center center no-repeat;
            background-size: cover;
            animation: animatedBackground 20s ease infinite;
        }

        form {
            width: 90%;
            max-width: 600px;
            height: 200px;
            padding: 30px;
            border-radius: 10px;
            background-color: rgba(255, 92, 97, 0.9);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            align-items: center;
            justify-content: center;
        }


        label {
            font-weight: bold;
            color: #333333;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            justify-content: center;
            
        }

        input[type="submit"] {
            background-color: #000000;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            justify-content: center;
            width: 200px;
            margin-left: 200px;
        }

        input[type="submit"]:hover {
            background-color: #333333;
        }

        a {
            display: block;
            text-align: bottom;
            margin-top: 20px;
            color: #333333;
            text-decoration: none;
            width: 80px;
            justify-content: center;
            margin-left: 245px;
        }

        strong {
            color: #ff6347;
            font-weight: bold;
        }

        /* Estilos adicionais para o botão de cadastrar */
        .btn-cadastrar {
            display: flex;
            text-align: bottom;
            background-color: #000000;
            color: #ffffff;
            padding: 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            justify-content: center;
        }

        .btn-cadastrar:hover {
            background-color: #333333;
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
    session_start();
    require './conectaBD.php';

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
    }

    mysqli_query($conn,"SET NAMES 'utf8'");
    mysqli_query($conn,'SET character_set_connection=utf8');
    mysqli_query($conn,'SET character_set_client=utf8');
    mysqli_query($conn,'SET character_set_results=utf8');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'];
        $user_type = $_POST['user_type']; // Recebendo o tipo de usuário

        if ($user_type === 'cliente') {
            $query_cliente = "SELECT * FROM Clientes WHERE cpf = '$login'";
            $result_cliente = $conn->query($query_cliente);

            if ($result_cliente->num_rows == 1) {
                $cliente = $result_cliente->fetch_assoc();
                $_SESSION['login'] = $login;
                $_SESSION['id_cliente'] = $cliente['id_cliente'];
                header("Location: ./pagina_cliente.php");
                exit();
            }
        } elseif ($user_type === 'funcionario') {
            $query_funcionario = "SELECT * FROM Funcionarios WHERE nome = '$login'";
            $result_funcionario = $conn->query($query_funcionario);

            if ($result_funcionario->num_rows == 1) {
                $funcionario = $result_funcionario->fetch_assoc();
                $_SESSION['login'] = $login;
                $_SESSION['id_funcionario'] = $funcionario['id_funcionario'];
                header("Location: ./pagina_funcionario.php");
                exit();
            }
        } elseif ($user_type === 'admin') {
            $admin_username = "admin";
            $admin_password = "1234";
    
            if ($login === $admin_username) {
                // Se o login é do admin, verifique a senha apenas para o admin
                if (isset($_POST['password']) && $_POST['password'] === $admin_password) {
                    $_SESSION['login'] = $login;
                    header("Location: ./admin.php");
                    exit();
                } else {
                    echo "Senha inválida para o admin.";
                }
            } else {
                echo "Login inválido para admin.";
            }
        }

        echo "<script>alert('Login inválido para clientes, funcionários ou admin.')</script>";
    }
    ?>

    <form method="post" action="" id="loginForm">
        <label for="login">Login (CPF para clientes / Nome para funcionários)</label><br>
        <input type="text" id="login" name="login"><br>

        <div id="passwordField" style="display: none;"> <!-- Campo de senha -->
            <label for="password">Senha:</label><br>
            <input type="password" id="password" name="password"><br>
        </div>

        <label for="user_type">Selecione o tipo de usuário:</label><br>
        <select name="user_type" id="user_type">
            <option value="cliente">Cliente</option>
            <option value="funcionario">Funcionário</option>
            <option value="admin">Admin</option>
        </select><br>

        <input type="submit" value="Entrar">
        <a href="./sign.php" class="btn-cadastrar">Cadastrar</a>
    </form>

    <script>
        document.getElementById('user_type').addEventListener('change', function() {
            var userType = this.value;
            var passwordField = document.getElementById('passwordField');

            if (userType === 'admin') {
                passwordField.style.display = 'block'; // Mostrar campo de senha
            } else {
                passwordField.style.display = 'none'; // Esconder campo de senha
            }
        });
    </script>

</body>
</html>