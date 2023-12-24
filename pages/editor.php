<?php 

  include_once('pages/valida-sentinela.php'); 

  date_default_timezone_set('America/Sao_Paulo');

  $horaAtual = date("H");
  
  if ($horaAtual >= 6 && $horaAtual < 12) {
      $saudacao = "Bom dia!";
  } elseif ($horaAtual >= 12 && $horaAtual < 18) {
      $saudacao = "Boa tarde!";
  } else {
      $saudacao = "Boa noite!";
  }

  // url da API
  $url2 = "http://localhost/webnotes/api/usuario/";

  $ch2 = curl_init();

  curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch2, CURLOPT_URL, $url2);

  $dados_users = curl_exec($ch2);

  curl_close($ch2);

  $dados_user = json_decode($dados_users,false);

  $nome = "";                           
  $email = "";               
  $id = 0;
  $senha = "";
  $id_anotacao = 0;                           
  $titulo = "";               
  $texto = "";

  if($dados_user->status == 200){
    foreach ($dados_user->dados as $linha_user){ 
      if($_SESSION['id'] == $linha_user->idUsuario) {
                       
        $nome .= $linha_user->nomeUsuario;                           
        $email .= $linha_user->emailUsuario;               
        $id .= $linha_user->idUsuario;
        $senha .= base64_decode($linha_user->senhaUsuario);
                     
      } 
    }
  }
  if (isset($_GET['id'])) {
    // url da API
    $url = "http://localhost/webnotes/api/anotacao/";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_URL, $url);

    $dados = curl_exec($ch);

    curl_close($ch);

    $dados_anotacao = json_decode($dados,false);
    
    if($dados_anotacao->status == 200){
      foreach ($dados_anotacao->dados as $linha_anotacao){ 
        if($_GET['id'] == $linha_anotacao->idTexto) {
                         
          $id_anotacao .= $linha_anotacao->idTexto;                           
          $titulo .= $linha_anotacao->tituloTexto;               
          $texto .= $linha_anotacao->texto;
                       
        } 
      }
    }
  }else{
    $id_anotacao = "";                           
    $titulo = "";               
    $texto = "";
  }

  include_once('pages/cookies-css.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Anotações</title>
        <link rel="icon" type="image/x-icon" href="assets/img/logo.svg" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="assets/css/estilo.css?19" rel="stylesheet">
        <link rel="stylesheet" href="assets/dist/ui/trumbowyg.min.css">
    </head>
    <body>
    
        <nav class="navbar navbar-expand-lg fixed-top py-3" id="mainNavLog">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="inicio"><img src="assets/img/logo.svg" alt=""> Web Notes</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="inicio"><i class="bi bi-file-earmark-text-fill"></i> Anotações</a></li>
                        <li class="nav-item"><a class="nav-link" href="configuracoes"><i class="bi bi-gear-fill"></i> Configurações</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout"><i class="bi bi-door-open-fill"></i> Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="hello">
          <div class="container">
            <h3> <?php echo "$saudacao "; echo $nome;?> 👋</h3>
            <hr>
          </div>
        </section>


        <section id="anotacoes">
          <div class="container">
            <form id="form-cad">
                <input type="hidden" name="id" class="form-control" value="<?php echo $id_anotacao; ?>" id="id" placeholder="id" required>  
                <br>
                <input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>" id="titulo" placeholder="Título da anotação" required>
                <br>
                <textarea name="texto" id="texto" class="form-control"><?php echo $texto;?></textarea>
                <div style="text-align: center;">
                    <button type="submit" class="btn-note">Salvar</button>
                </div>
            </form> 
          </div>
        </section>

        <script src="assets/js/sweetalert2.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/dist/trumbowyg.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
        <script src="assets/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
        <script src="assets/dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
        <script src="assets/dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
        <script>
          $('#texto').trumbowyg({
              btns: [
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['fontfamily'],
                ['fontsize'],
                ['link'],,
                ['insertImage'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['emoji'],
                ['removeformat'],
                ['fullscreen']
              ],  
              plugins: {
                fontfamily: {
                    fontList: [
                        {name: 'Arial', family: 'Arial, Helvetica, sans-serif'},
                        {name: 'Comic Sans', family: '\'Comic Sans MS\', Textile, cursive, sans-serif'},
                        {name: 'Open Sans', family: '\'Open Sans\', sans-serif'}
                    ]
                },
                fontsize: {
                    sizeList: [
                        '12px',
                        '14px',
                        '16px'
                    ]
                },
                resizimg: {
                    minSize: 64,
                    step: 16,
                },

            } 
          });
      
          
        </script>
        <script>

          const formcad = document.getElementById('form-cad');

          if(formcad){
              formcad.addEventListener("submit",async (e) =>{
              
                  e.preventDefault();
              
                  const dadosForm = new FormData(formcad);

                  const dados = await fetch("http://localhost/webnotes/api/anotacao/",{
                      method: "POST",
                      body: dadosForm
                  });
              
                  const resposta = await dados.json();
                  console.log(resposta);

                  if(resposta['status']){
                
                    Swal.fire({
                    text: resposta['msg'],
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Fechar'
                    }).then((result) => {
                        if (result.isConfirmed) {                            
                          window.location = "inicio";
                        }else{
                          window.location = "inicio";           
                        }
                    });

                  }else{
                      Swal.fire({
                      text: resposta['msg'],
                      icon: 'error',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Fechar'
                      });
                  }

              });
          }
        </script> 
        
    </body>
</html>