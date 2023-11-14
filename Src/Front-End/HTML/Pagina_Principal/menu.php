<!-------------------------------------------------------------------------------
    Banco de Dados
    PUCPR
    Projeto BD
    Novembro/2023
---------------------------------------------------------------------------------->
<!-- menu.php -->

<!-- Top -->
<div class="w3-top">
    <div class="w3-row w3-white w3-padding">
        <!-- Logotipo -->
        <div class="w3-half" style="margin:0 0 0 0">
            <a href="."><img src='imagens/logo_pandoka.jpeg' alt=' Logo pandoka ' width="20%"></a>
        </div>
        <!-- Outra metade (possivelmente menu) -->
        <div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
            <div class="w3-right">
            </div>
        </div>
    </div>
    <!-- Barra de navegação superior -->
    <div class="w3-bar w3-theme w3-large" style="z-index:-1">
        <a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-theme w3-padding-16" href="javascript:void(0)" onclick="w3_open()">☰</a>
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="medListar.php" onclick="w3_show_nav('menuMedico')">Usuário</a>
    </div>
</div>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index:3;width:270px" id="mySidebar">
    <div class="w3-bar w3-hide-large w3-large">
        <!-- Botão para mostrar menu -->
        <a href="javascript:void(0)" onclick="w3_show_nav('menuMedico')" class="w3-bar-item w3-button w3-theme w3-hover-light-gray w3-padding-16" style="width:50%">Usúarios</a>
    </div>
    <!-- Botão para fechar o menu -->
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large" title="Close Menu">x</a>
    <!-- Conteúdo do menu, possivelmente relacionado a um sistema médico ou panificadora -->
    <div id="menuMedico" class="myMenu">
        <div class="w3-container">
            <h3>Menu Panificadora</h3>
        </div>
        <a class="w3-bar-item w3-button" href="medListar.php">Catálogo de produtos</a>
        <a class="w3-bar-item w3-button" href="medIncluir.php">Carrinho de Compras</a>
        <a class="w3-bar-item w3-button" href="medIncluir.php">Gerenciar Produtos</a>
    </div>
</div>

<!-- Inclusão do script JavaScript -->
<script type="text/javascript" src="js/myScriptClinic.js"></script>
