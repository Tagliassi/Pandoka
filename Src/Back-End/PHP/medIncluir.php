<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- medIncluir.php -->

<html>
<head>

    <title>Clínica Médica ABC</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
	
</head>
<body  onload="w3_show_nav('menuMedico')">

<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php';?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado paa direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <!-- h1 class="w3-xxlarge">Contratação de Médico</h1 -->
        <p class="w3-large">
            <div class="w3-code cssHigh notranslate">
                <!-- Acesso em:-->
                <?php

                date_default_timezone_set("America/Sao_Paulo");
                $data = date("d/m/Y H:i:s", time());
                echo "<p class='w3-small' > ";
                echo "Acesso em: ";
                echo $data;
                echo "</p> "
                ?>
				<!-- Acesso ao BD-->
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

				// Faz Select na Base de Dados
				$sqlG = "SELECT ID_Espec, Nome_Espec FROM Especialidade";
				
				$optionsEspec = array();
				
				if ($result = mysqli_query($conn, $sqlG)) {
					while ($row = mysqli_fetch_assoc($result)) {
                       array_push($optionsEspec, "\t\t\t<option value='". $row["ID_Espec"]."'>".$row["Nome_Espec"]."</option>\n");
					}
				}

				?>

                <div class="w3-responsive w3-card-4">
                    <div class="w3-container w3-theme">
                        <h2>Informe os dados do novo do Médico</h2>
                    </div>
                    <form class="w3-container" action="medIncluir_exe.php" method="post" enctype="multipart/form-data">
					<table class='w3-table-all'>
					<tr>
                        <td style="width:50%;">
						<p>
						<label class="w3-text-IE"><b>Nome</b>*</label>
						<input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$"
							   title="Nome entre 10 e 100 letras." required></p>
						<p>
						<label class="w3-text-IE"><b>CRM</b>*</label>
						<input class="w3-input w3-border w3-light-grey " name="CRM" id="CRM"  type="text" maxlength="15"
						       placeholder="CRM/UF XXXX-XX" title="CRM/UF XXXX-XX"  pattern="CRM\/([A-Z]{2}) [0-9]{4}-[0-9]{2}$" required></p>
						<p>
						<label class="w3-text-IE"><b>Data de Nascimento</b></label>
						<input class="w3-input w3-border w3-light-grey" name="DataNasc" type="date"
							   placeholder="dd/mm/aaaa" title="dd/mm/aaaa"</p>
						<p>
						<p><label class="w3-text-IE"><b>Especialidade</b>*</label>
								<select name="Especialidade" id="Especialidade" class="w3-input w3-border w3-light-grey" required>
									<option value=""></option>
								<?php
									foreach($optionsEspec as $key => $value){
										echo $value;
									}
								?>
								</select>
						</p>

						
						</td>
						<td>
						<p style="text-align:center"><label class="w3-text-IE"><b>Minha Imagem para Identificação: </b></label></p>
						<p style="text-align:center"><img id="imagemSelecionada" src="imagens/pessoa.jpg"    /></p>
						<p style="text-align:center"><label class="w3-btn w3-theme">Selecione uma Imagem 
							<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
							<input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);"></label>
						</p>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center">
						<p>
						<input type="submit" value="Salvar" class="w3-btn w3-theme" >
						<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='medListar.php'">
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

	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>

</body>
</html>
