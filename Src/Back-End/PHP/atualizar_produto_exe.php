<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Banco de Dados
    PUCPR
    Projeto BD
    Novembro/2023
---------------------------------------------------------------------------------->
<!-- medAtualizar.php -->

<html>
<head>
    <title>Panificadora Pandoka</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Inclusão de estilos CSS externos -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuMedico')">
    <!-- Inclusão do menu -->
    <?php require '../../Front-End/HTML/Pagina_Principal/menu.php'; ?>
    <?php require '../../Back-End/PHP/conectaBD.php'; ?>

    <!-- Conteúdo Principal: deslocado para a direita em 270 pixels quando a sidebar é visível -->
    <div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">

            <p class="w3-large">
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
                    <div class="w3-container w3-theme">
                        <h2>Atualização de Médico</h2>
                    </div>
                    <!-- Acesso ao BD e atualização dos dados -->
                    <?php
                    $id = $_POST['Id'];
                    $nome = $_POST['Nome'];
                    $CRM = $_POST['CRM'];
                    $dtNasc = $_POST['DataNasc'];
                    $espec = $_POST['Especialidade'];

                    $conn = mysqli_connect($servername, $username, $password, $database);

                    if (!$conn) {
                        die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
                    }

                    mysqli_query($conn, "SET NAMES 'utf8'");
                    mysqli_query($conn, 'SET character_set_connection=utf8');
                    mysqli_query($conn, 'SET character_set_client=utf8');
                    mysqli_query($conn, 'SET character_set_results=utf8');
                    ?>

                    <?php
                    if ($_FILES['Imagem']['size'] == 0) {
                        $sql = "UPDATE Medico SET Nome = '$nome', CRM = '$CRM', Dt_Nasc = '$dtNasc' WHERE ID_Medico = $id";
                    } else {
                        $imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name']));
                        $sql = "UPDATE Medico SET Nome = '$nome', CRM = '$CRM', Dt_Nasc = '$dtNasc', Foto = '$imagem' WHERE ID_Medico = $id";
                    }

                    echo "<div class='w3-responsive w3-card-4'>";
                    if ($result = mysqli_query($conn, $sql)) {
                        echo "<p>&nbsp;Registro alterado com sucesso! </p>";
                    } else {
                        echo "<p>&nbsp;Erro executando UPDATE: " . mysqli_error($conn) . "</p>";
                    }
                    echo "</div>";
                    mysqli_close($conn);
                    ?>
                </div>
            </div>

            <!-- Inclusão do modal "Sobre" -->
            <?php require '../../Front-End/HTML/Pagina_Principal/sobre.php';?>
            <!-- FIM PRINCIPAL -->
        </div>

        <!-- Inclusão do rodapé -->
        <?php require '../../Front-End/HTML/Pagina_Principal/rodape.php';?>

    </body>
</html>
