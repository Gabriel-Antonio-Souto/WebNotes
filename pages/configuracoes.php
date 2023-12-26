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
  $url = "http://localhost/webnotes/api/usuario/";

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_URL, $url);

  $dados = curl_exec($ch);

  curl_close($ch);

  $dados_user = json_decode($dados,false);

  $nome = "";                           
  $email = "";               
  $id = "";
  $senha = "";

  if($dados_user->status == 200){
    foreach ($dados_user->dados as $linha){ 
      if($_SESSION['id'] == $linha->idUsuario) {
                       
        $nome .= $linha->nomeUsuario;                           
        $email .= $linha->emailUsuario;               
        $id .= $linha->idUsuario;
        $senha .= base64_decode($linha->senhaUsuario);
                     
      } 
    }
  }

  include_once('pages/cookies-css.php');
?>
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Configurações</title>
        <link rel="icon" type="image/x-icon" href="assets/img/logo.svg" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="assets/css/estilo.css?1922" rel="stylesheet">
    </head>
    <body>

          <?php
            // cookies
            include_once('pages/cookies-css.php');
            ?>
             
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
            
            <section style="margin-bottom: 50px;">
              <div class="container">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;"><symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></symbol></svg>
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                  <div>
                    Este site utiliza Cookies!<br>
                    As opções selecionadas serão armanenadas no armazenamento local do seu navegador. <br>
                    Observação: Se você acessar sua conta em outro dispositivo ou navegador, as opções salvas não estarão disponíveis.
                  </div>
                </div>
                
                
                  <div class="card-group">
                      <div class="card">                    
                        <div class="card-body">
                          <h3 class="card-title">Dados:</h3>
                          <br>
                          <p class="card-text">
                            <h6>ID: <?php echo $id;?></h6>                              
                            <form id="user_upadate">
                              <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>" required>   
                              <br>
                              <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
                              <br>
                              <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>     
                              <br>
                              <button type="submit" class="btn btn-primary">Salvar</button>     
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#senhaModal">Alterar Senha</button> 
                              <button type="button" data-bs-toggle="modal" data-bs-target="#excluir" class="btn btn-danger">Excluir Conta</button>                   
                            </form>                          
                          </p>
                        </div>
                      </div>
                      <div class="card">
                        
                        <div class="card-body">
                          <h3 class="card-title">Opções:</h3>
                          <p class="card-text">
                          <br>
                          <!--formulário de modo-->
                          <form method="post" action="cor">
                              <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label"><h6><i class="bi bi-brightness-high-fill"></i> <i class="bi bi-moon-fill"></i> Modo:</h6></label>
                                <div class="col-sm-10">
                                  <select class="form-select" name="corSelect">
                                    <option value="">Original</option>
                                    <option value="rgba(12, 12, 12, 0.85)">Escuro</option>
                                  </select>
                                </div>
                                <br>
                              </div>
                              <input class="btn btn-primary" id="config" type="submit" name="Submit" value="Aplicar" />
                          </form>
            
                          </p>
                        </div>
                      </div>
                     
                  </div>
    
                </div>
            </section>
      
          <div class="modal fade" id="senhaModal" tabindex="-1" aria-labelledby="senhaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content" id="div-login">
                <div class="modal-header" style="border:none;">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h3 style="text-align:center;color: black;font-weight: 700;">Alterar Senha</h3>
                
                    <div class="form-login">
                      <form id="form_senha">
                          <input type="password" name="senha" class="login" id="senha" placeholder="Informe a senha atual" required>
                          <br>
                          <input type="password" name="nova_senha" class="login" id="nova_senha" placeholder="Insira sua nova senha" required>
                          <br>
                          <input type="password" name="nova_confirmar" class="login" id="nova_confirmar" placeholder="Insira sua nova senha novamente" required>
                          <br>                         
                          <button type="submit" class="btn-login">Alterar</button>
                      </form>
                    </div>
                      
                </div>
                <div class="modal-footer" style="border:none;">
                
                </div>
              </div>
            </div>
          </div>

            <!-- Excluir conta -->
            <div class="modal fade" id="excluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header bg-danger">
                              <h5 class="modal-title text-white" id="exampleModalLabel">Excluir Conta</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Deseja mesmo excluir sua conta?
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="apagarDados(<?php echo $id;?>)">Excluir</button>

                          </div>
                      </div>
                  </div>
              </div>

        <script src="assets/js/sweetalert2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script>

            const user_upadate = document.getElementById('user_upadate');

            if(user_upadate){
                user_upadate.addEventListener("submit",async (e) =>{
                
                    e.preventDefault();

                    var id = document.getElementById('id').value
                    var nome = document.getElementById('nome').value
                    var email = document.getElementById('email').value

                    const dados = await fetch("http://localhost/webnotes/api/usuario/?id="+id+"&nome="+nome+"&email="+email,{
                        method: "PUT",
                    });
                
                    const resposta = await dados.json();
                    
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
                        })

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

            const formSenha = document.getElementById('form_senha');

            if(formSenha){
                formSenha.addEventListener("submit",async (e) =>{
                
                    e.preventDefault();
                
                    const dadosForm = new FormData(formSenha);

                    const dados = await fetch("http://localhost/webnotes/api/senha/alterar/",{
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
                        })

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

              const dados = await fetch('http://localhost/webnotes/api/usuario/?id='+id,{
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
                      window.location = "home";
                    }else{
                      window.location = "home";           
                    }
                });

            }

          </script>
    </body>
</html>