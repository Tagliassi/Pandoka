// Função para abrir a barra lateral
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

// Função para fechar a barra lateral
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}

// Função para mostrar a navegação com base no nome
function w3_show_nav(name) {
  // Oculta o menu 'menuMedico'
  document.getElementById("menuMedico").style.display = "none";
  // Exibe o menu correspondente ao 'name'
  document.getElementById(name).style.display = "block";
}

// Função para ocultar o menu 'menuMedico'
function w3_show_none() {
  document.getElementById("menuMedico").style.display = "none";
}

// Função para validar e exibir uma imagem selecionada
function validaImagem(input) {
  var caminho = input.value;

  if (caminho) {
    // Obtém o nome do arquivo a partir do caminho
    var comecoCaminho = (caminho.indexOf('\\') >= 0 ? caminho.lastIndexOf('\\') : caminho.lastIndexOf('/'));
    var nomeArquivo = caminho.substring(comecoCaminho);

    // Remove a barra inicial (caso exista)
    if (nomeArquivo.indexOf('\\') === 0 || nomeArquivo.indexOf('/') === 0) {
      nomeArquivo = nomeArquivo.substring(1);
    }

    // Obtém a extensão do arquivo
    var extensaoArquivo = nomeArquivo.indexOf('.') < 1 ? '' : nomeArquivo.split('.').pop();

    // Verifica se a extensão é uma imagem suportada
    if (extensaoArquivo != 'gif' &&
        extensaoArquivo != 'png' &&
        extensaoArquivo != 'jpg' &&
        extensaoArquivo != 'jpeg') {
      input.value = '';
      alert("É preciso selecionar um arquivo de imagem (gif, png, jpg ou jpeg)");
    }
  } else {
    input.value = '';
    alert("Selecione um caminho de arquivo válido");
  }

  // Se houver um arquivo selecionado
  if (input.files && input.files[0]) {
    // Obtém o tamanho do arquivo em MB
    var arquivoTam = input.files[0].size / 1024 / 1024;

    // Verifica se o arquivo é uma imagem com menos de 16 MB
    if (arquivoTam < 16) {
      // Exibe a imagem selecionada
      var reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('imagemSelecionada').setAttribute('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    } else {
      // Se o arquivo for maior que 16 MB, exibe um alerta e limpa o input
      input.value = '';
      alert("O arquivo precisa ser uma imagem com menos de 16 MB");
    }
  } else {
    // Se não houver arquivo selecionado, limpa a imagem exibida
    document.getElementById('imagemSelecionada').setAttribute('src', '#');
  }
}
