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
            background: url('../IMGS/gif.gif') no-repeat center center fixed;
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

        nav img {
            width: 250px;
            height: auto;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
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
    <img class="logo"  src="../IMGS/logo_pandoka.jpeg" alt="Logo da Panificadora Pandoka">
    <ul>
        <li><a href="./catalogo_produtos.php">Catálogo de Produtos</a></li>
        <li><a href="./carrinho_compras.php">Carrinho de Compras</a></li>
        <li><a href="./login.php">Sair</a></li>
        <li><a href="./meu_perfil.php">Meu Perfil</a></li>
    </ul>
</nav>

</body>
</html>
