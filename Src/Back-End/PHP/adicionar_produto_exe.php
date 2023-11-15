<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Banco de Dados
    PUCPR
    Projeto BD
    Novembro/2023
---------------------------------------------------------------------------------->
<!-- medIncluir_exe.php -->

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
    <?php require '../../Front-End/HTML/Pagina_Principal/menu.php';?>
    <?php require '../../Back-End/PHP/conectaBD.php'; ?>
    
    <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
    <div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <p class="w3-large">
                <div class="w3-code cssHigh notranslate">
                    <!-- Informações sobre o acesso à página -->
                    <?php
                    date_default_timezone_set("America/Sao_Paulo");
                    $data = date("d/m/Y H:i:s",time());
                    echo "<p class='w3-small' > ";
                    echo "Acesso em: ";
                    echo $data;
                    echo "</p> "
                    ?>

                    <!-- Acesso ao BD -->
                    <?php
                    // Recupera os dados do formulário
                    $nome    = $_POST['Nome'];
                    $CRM     = $_POST['CRM'];
                    $dtNasc  = $_POST['DataNasc'];
                    $espec   = $_POST['Especialidade'];

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

                    // Faz Select na Base de Dados
                    if ($_FILES['Imagem']['size'] == 0) { // Não recebeu uma imagem binária
                        $sql = "INSERT INTO Medico (Nome, CRM, Dt_Nasc, ID_Espec, Foto) VALUES ('$nome','$CRM','$dtNasc', '$espec', NULL)";
                    } else {                              // Recebeu uma imagem binária
                        $imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name'])); // Prepara para salvar em BD
                        $sql = "INSERT INTO Medico (Nome, CRM, Dt_Nasc, ID_Espec, Foto) VALUES ('$nome','$CRM','$dtNasc', '$espec','$imagem')";
                    }
                    ?>
                    <!-- Div para exibir mensagens -->
                    <div class='w3-responsive w3-card-4'>
                        <div class="w3-container w3-theme">
                            <h2>Inclusão de Novo Médico</h2>
                        </div>
                        <?php
                        // Executa a query SQL
                        if ($result = mysqli_query($conn, $sql)) {
                            echo "<p>&nbsp;Registro cadastrado com sucesso! </p>";
                        } else {
                            echo "<p>&nbsp;Erro executando INSERT: " . mysqli_error($conn) . "</p>";
                        }
                        ?>
                    </div>
                    <?php
                    mysqli_close($conn);  //Encerra conexão com o BD
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
