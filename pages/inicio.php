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
  $id = "";
  $senha = "";

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

  // url da API
  $url = "http://localhost/webnotes/api/anotacao/";

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_URL, $url);

  $dados = curl_exec($ch);

  curl_close($ch);

  $dados_anotacao = json_decode($dados,false);

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
            <h3> <?php echo "$saudacao "; echo $nome?> 👋</h3>
            <hr>
          </div>
        </section>

        <section>
          <div class="container">
            <!-- Button trigger modal -->
            <a href="editor"><button type="button" class="btn-note">
              <i class="bi bi-pencil-fill"></i> Nova Anotação
            </button></a>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content" id="note">
                <div class="modal-header" style="border:none;">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h3 style="text-align:center;color: black;font-weight: 700;">Editor</h3>
                
                    <form id="form-cad">
                      <input type="text" name="titulo" class="login" id="titulo" placeholder="Título da anotação" required>
                      <br>
                      <textarea name="texto" id="texto" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer" style="border:none;">
                      <button type="submit" class="btn-login">Salvar</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </section>


        <section id="anotacoes">
          <div class="container">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Título</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody>
              
                <?php
                    if($dados_anotacao->status == 200){
                      foreach ($dados_anotacao->dados as $linha){ 
                        if($_SESSION['id'] == $linha->idUsuario) {                                
                ?>

                <tr>
                  <th scope="row"><?php echo $linha->idTexto;?></th>
                  <td><?php echo $linha->tituloTexto;?></td>
                  <td>
                    <a href="editor?id=<?php echo $linha->idTexto;?>" class="btn btn-primary"><i class="bi bi-eye-fill"></i> Visualizar</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#excluir<?php echo $linha->idTexto;?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Excluir</a>             
                  </td>
                </tr>                   
              
               <!-- Excluir -->
              <div class="modal fade" id="excluir<?php echo $linha->idTexto;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header bg-danger">
                              <h5 class="modal-title text-white" id="exampleModalLabel">Deseja mesmo excluir este item?</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <?php echo $linha->tituloTexto;?>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                              <button id="<?php echo $linha->idTexto;?>" type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="apagarDados(<?php echo $linha->idTexto;?>)">Excluir</button>

                          </div>
                      </div>
                  </div>
              </div>

            <?php
                    }
                  }
                }
            ?>
              
              </tbody>
            </table>
          </div>
        </section>

        <script src="assets/js/sweetalert2.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/dist/trumbowyg.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script>
          $('#texto').trumbowyg({
              btns: [
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
              ],   
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
                          window.location.reload();
                        }else{
                          window.location.reload();           
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
        <script>

            async function apagarDados(id) {

            const dados = await fetch('http://localhost/webnotes/api/anotacao/?id='+id,{
                method: "DELETE",
            });

            const resposta = await dados.json();

            Swal.fire({
                text: resposta['msg'],
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Fechar'
              }).then((result) => {
                  if (result.isConfirmed) {                            
                    window.location.reload();
                  }else{
                    window.location.reload();           
                  }
              });

            }
           
        </script>

    </body>
</html>