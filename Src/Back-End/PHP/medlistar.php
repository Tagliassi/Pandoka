<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Banco de Dados
    PUCPR
    Projeto BD
    Novembro/2023
---------------------------------------------------------------------------------->
<!-- medListar.php -->

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
    <?php require 'geral/menu.php'; ?>
    <?php require 'bd/conectaBD.php'; ?>

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

                    // Faz Select na Base de Dados
                    $sql = "SELECT ID_Medico, CRM, Nome, Nome_Espec AS Especialidade, Foto, Dt_Nasc FROM Medico AS M INNER JOIN Especialidade AS E ON (M.ID_Espec = E.ID_Espec)";
                    echo "<div class='w3-responsive w3-card-4'>";
                    if ($result = mysqli_query($conn, $sql)) {
                        // Cabeçalho da tabela
                        echo "<table class='w3-table-all'>";
                        echo "	<tr>";
                        echo "	  <th width='7%'>Código</th>";
                        echo "	  <th width='14%'>Categoria</th>";
                        echo "	  <th width='14%'>Nome do produto</th>";
                        echo "	  <th width='18%'>Valor Unitário</th>";
                        echo "	  <th width='15%'>Disponibilidade</th>";
                        echo "	  <th width='10%'>Quantidade</th>";
                        echo "	  <th width='8%'>Comprar</th>";
                        echo "	  <th width='7%'> </th>";
                        echo "	  <th width='7%'> </th>";
                        echo "	</tr>";
                        if (mysqli_num_rows($result) > 0) {
                            // Apresenta cada linha da tabela
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Formatação da data de nascimento
                                $data = $row['Dt_Nasc'];
                                list($ano, $mes, $dia) = explode('-', $data);
                                $nova_data = $dia . '/' . $mes . '/' . $ano;
                                // Cálculo da idade
                                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                                $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
                                $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                                // Criação das células da tabela
                                $cod = $row["ID_Medico"];
                                echo "<tr>";
                                echo "<td>";
                                echo $cod;
                                echo "</td><td>";
                                echo $row["CRM"];
                                // Exibição da foto se existir
                                if ($row['Foto']) {?>
                                    <td>
                                        <img id="imagemSelecionada" class="w3-circle w3-margin-top" src="data:image/png;base64,<?= base64_encode($row['Foto']) ?>" />
                                    </td><td>
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                        <img id="imagemSelecionada" class="w3-circle w3-margin-top" src="imagens/pessoa.jpg" />
                                    </td><td>
                                    <?php
                                }
                                echo $row["Nome"];
                                echo "</td><td>";
                                echo $row["Especialidade"];
                                echo "</td><td>";
                                echo $nova_data;
                                echo "</td><td>";
                                echo $idade;
                                echo "</td>";
                                // Botões para atualizar e excluir registros de médicos
                                echo "<td>";       
                                echo "<a href='medAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Médico' width='32'></a>";
                                echo "</td><td>";
                                echo "<a href='medExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Médico' width='32'></a>";
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
        <?php require 'geral/sobre.php';?>
        <!-- FIM PRINCIPAL -->
    </div>
    <!-- Inclui RODAPE.PHP  -->
    <?php require 'geral/rodape.php';?>

</body>
</html>
