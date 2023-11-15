<!DOCTYPE html>
<html>
<head>
    <title>Panificadora Pandoka</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Inclusão de estilos CSS externos -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuMedico')">

    <!-- Inclusão do menu e conexão com o banco de dados -->
    <?php require '../../Front-End/HTML/Pagina_Principal/menu.php'; ?>
    <?php require '../../Back-End/PHP/conectaBD.php'; ?>

    <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
    <div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <p class="w3-large">
                <p>
                <div class="w3-code cssHigh notranslate">
                    <!-- Informações sobre o acesso à página -->
                    <?php
                    date_default_timezone_set("America/Sao_Paulo");
                    $data = date("d/m/Y H:i:s", time());
                    echo "<p class='w3-small' > ";
                    echo "Acesso em: ";
                    echo $data;
                    echo "</p> "
                    ?>
                    <!-- Título da página -->
                    <div class="w3-container w3-theme">
                        <h2>Catálogo de Produtos</h2>
                    </div>

                    <!-- Acesso ao BD -->
                    <?php
                    // Cria conexão
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    
                    // Verifica conexão 
                    if (!$conn) {
                        echo "</table>";
                        echo "</div>";
                        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
                    }
                    
                    // Configura para trabalhar com caracteres acentuados do português
                    mysqli_query($conn,"SET NAMES 'utf8'");
                    mysqli_query($conn,'SET character_set_connection=utf8');
                    mysqli_query($conn,'SET character_set_client=utf8');
                    mysqli_query($conn,'SET character_set_results=utf8');

                    // Verifica se o cliente está logado e obtém o ID do cliente (implementar)
                    $id_cliente_logado = 1; // Substituir pelo ID do cliente logado

                    // Verifica se o funcionario está logado e obtém o ID do funcionario (implementar)
                    $id_funcionario_logado = 2; // Substituir pelo ID do funcionario logado

                    // Faz Select na Base de Dados
                    $sql = "SELECT id_produto, nome, valor, disponibilidade, quantidade_estoque FROM Produtos";

                    // Cria Catálogo de Produtos
                    echo "<div class='w3-responsive w3-card-4'>";
                    if ($result = mysqli_query($conn, $sql)) {

                        // Cabeçalho da tabela
                        echo "<table class='w3-table-all'>";
                        echo "<tr>";
                        echo "<th width='5%'>Código</th>";
                        echo "<th width='20%'>Nome do Produto</th>";
                        echo "<th width='15%'>Valor Unitário</th>";
                        echo "<th width='15%'>Disponibilidade</th>";
                        echo "<th width='20%'>Quantidade em Estoque</th>";
                        echo "<th width='5%'>Carrinho</th>";
                        echo "</tr>";

                        if (mysqli_num_rows($result) > 0) {
                            
                            // Apresenta cada linha da tabela
                            while ($row = mysqli_fetch_assoc($result)) {
                                $codigo = $row["id_produto"];
                                $valor_unitario = number_format($row['valor'], 2, ',', '.'); 
                            
                                echo "<tr>";
                                echo "<td>{$codigo}</td>";
                                echo "<td>{$row['nome']}</td>"; 
                                echo "<td>R$ {$valor_unitario}</td>";
                                echo "<td>{$row['disponibilidade']}</td>";
                                echo "<td>{$row['quantidade_estoque']} unidades</td>";
                                echo "<td>";
                            
                                // Verificação da disponibilidade do produto
                                if ($row['disponibilidade'] == true && $row['quantidade_estoque'] > 0) {
                                    // Formulário para adicionar ao carrinho
                                    echo "<form action='carrinho_compras.php' method='post'>";
                                    echo "<input type='hidden' name='produto_id' value='{$codigo}'>";
                                    echo "<input type='hidden' name='id_cliente' value='{$id_cliente_logado}'>";
                                    echo "<input type='number' name='quantidade' min='1' max='{$row['quantidade_estoque']}' placeholder='Quantidade' required>";
                                    echo "<input type='submit' value='Adicionar ao Carrinho'>";
                                    echo "</form>";
                                } else {
                                    echo "Produto Indisponível"; 
                                }
                            
                                echo "</td>";
                                echo "</tr>";
                            }
                        }

                        echo "</table>";
                        echo "</div>";

                    } else {
                        echo "Erro executando SELECT: " . mysqli_error($conn);
                    }

                    // Fecha a conexão com o BD
                    mysqli_close($conn);
                    ?>

                    </div>
                </p>
            </div>

            <!-- Inclusão do modal "Sobre" -->
            <?php require '../../Front-End/HTML/Pagina_Principal/sobre.php';?>
            <!-- FIM PRINCIPAL -->
        </div>
        <!-- Inclui RODAPE.PHP  -->
        <?php require '../../Front-End/HTML/Pagina_Principal/rodape.php';?>

    </body>
</html>
