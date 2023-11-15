<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Banco de Dados
    PUCPR
    Projeto BD
    Novembro/2023
---------------------------------------------------------------------------------->
<!-- medIncluir.php -->

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
                    $data = date("d/m/Y H:i:s", time());
                    echo "<p class='w3-small' > ";
                    echo "Acesso em: ";
                    echo $data;
                    echo "</p> "
                    ?>

                    <!-- Acesso ao BD -->
                    <?php
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

                    // Faz Select na Base de Dados para carregar as opções de especialidade
                    $sqlG = "SELECT ID_Espec, Nome_Espec FROM Especialidade";
                    $optionsEspec = array();

                    if ($result = mysqli_query($conn, $sqlG)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Cria um array com as opções de especialidade
                            array_push($optionsEspec, "\t\t\t<option value='". $row["ID_Espec"]."'>".$row["Nome_Espec"]."</option>\n");
                        }
                    }
                    ?>

                    <!-- Formulário para inclusão de médico -->
                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do novo produto</h2>
                        </div>
                        <form class="w3-container" action="medIncluir_exe.php" method="post" enctype="multipart/form-data">
                            <table class='w3-table-all'>
                                <tr>
                                    <td style="width:50%;">
                                        <p>
                                            <label class="w3-text-IE"><b>id_produto</b>*</label>
                                            <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$"
                                                   title="Nome entre 10 e 100 letras." required>
                                        </p>
                                        <!-- Outros campos do formulário -->
                                        <p>
                                            <label class="w3-text-IE"><b>Nome</b>*</label>
                                            <input class="w3-input w3-border w3-light-grey " name="CRM" id="CRM"  type="text" maxlength="15"
                                                   placeholder="CRM/UF XXXX-XX" title="CRM/UF XXXX-XX"  pattern="CRM\/([A-Z]{2}) [0-9]{4}-[0-9]{2}$" required>
                                        </p>
                                        <p>
                                            <label class="w3-text-IE"><b>Valor Unitário, quantidade_estoque, disponibilidade</b></label>
                                            <input class="w3-input w3-border w3-light-grey" name="DataNasc" type="date"
                                                   placeholder="dd/mm/aaaa" title="dd/mm/aaaa">
                                        </p>
                                        <p>
                                            <label class="w3-text-IE"><b>Categoria</b>*</label>
                                            <select name="Especialidade" id="Especialidade" class="w3-input w3-border w3-light-grey" required>
                                                <option value=""></option>
                                                <?php
                                                // Exibe as opções de especialidade no menu dropdown
                                                foreach($optionsEspec as $key => $value){
                                                    echo $value;
                                                }
                                                ?>
                                            </select>
                                        </p>
                                    </td>
                                    <td>
                                        <!-- Área para exibição de imagem -->
                                        <p style="text-align:center"><label class="w3-text-IE"><b>não tem imagem: </b></label></p>
                                        <p style="text-align:center"><img id="imagemSelecionada" src="imagens/pessoa.jpg"/></p>
                                        <p style="text-align:center"><label class="w3-btn w3-theme">Selecione uma Imagem
                                                <input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
                                                <input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);">
                                            </label>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Botões de ação do formulário -->
                                    <td colspan="2" style="text-align:center">
                                        <p>
                                            <input type="submit" value="Salvar" class="w3-btn w3-theme">
                                            <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='catalogo_produtos.php'">
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
                    </div>
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
