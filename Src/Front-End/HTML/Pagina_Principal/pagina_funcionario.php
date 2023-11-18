<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sua Página</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: url('../../../Front-End/IMGS/gif.gif') no-repeat center center fixed;
            background-size: cover;
            animation: animatedBackground 20s ease infinite;
            height: 100vh;
        }

        nav {
            background: linear-gradient(to right, #ff444b, #ff5c61);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        nav h2 {
            margin: 0;
            color: #ffffff;
        }

        nav img {
            width: 200px; /* Ajuste o tamanho desejado */
            height: auto;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #000000;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
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

    <nav>
        <img src="../../IMGS/logo_pandoka.jpeg" alt="Logo da Panificadora Pandoka">
        <ul>
            <li><a href="../../../Back-End/PHP/catalogo_produtos_funcionario.php">Catálogo de Produtos</a></li>
            <li><a href="../../../Back-End/PHP/adicionar_produto.php">Adicionar Produto</a></li>
            <li><a href="../../HTML/Sign_And_Login/login.php">Sair</a></li>
        </ul>
    </nav>

<!-- Conteúdo da página -->
<div>
    <!-- Seu conteúdo aqui -->
</div>
</body>
</html>
