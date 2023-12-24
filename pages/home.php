<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Web Notes</title>
        <link rel="icon" type="image/x-icon" href="assets/img/logo.svg" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="assets/css/estilo.css?1922" rel="stylesheet">
    </head>
    <body>

        <!-- Menu -->
        <nav class="navbar navbar-expand-lg fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#"><img src="assets/img/logo.svg" alt=""> Web Notes</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#cadModal">Cadastra-se</a></li>
                        <li class="nav-item"><a class="nav-link" href="https://gabriel-antonio-souto.github.io/meu_portfolio/">Desenvolvedor</a></li>
                        <li class="nav-item"><a class="nav-link" href="https://github.com/Gabriel-Antonio-Souto/WebNotes"><i class="bi bi-github"></i> GitHub</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <section id="sobre">
            <div class="main">
                <div class="left">
                    <div class="cartao">
                        <h1>Web Notes</h1>                   
                        <p>Um editor simples e fácil de usar</p>           
                        <a href="#" data-bs-toggle="modal" data-bs-target="#cadModal"><button type="button" class="cadastro">Cadastra-se</button></a>
                    </div>
                </div>
                <div class="right">
                    <img src="assets/img/img1.svg" alt="">
                </div>
            </div>       
        </section>

        <!-- Sobre -->
        <section>
            <div class="main">
                <div class="right">
                    <img src="assets/img/img2.svg" alt="">
                </div>
                <div class="left">
                    <div class="cartao">
                        <h2><b>Simples de Usar</b></h2>                
                        <p>Crie e edite suas anotações gratuitamente em qualquer lugar.</p>           
                    </div>
                </div>
            </div>       
        </section>
        
        <!-- Sobre -->
        <section id="about">
            <div class="main">
                <div class="left">
                    <div class="cartao">
                        <h2><b>Tudo Salvo no Próprio Editor</b></h2>                   
                        <p>Todas as anotações são salvas no próprio editor com isso você poderá criar e editar em qualquer aparelho.</p>           
                    </div>
                </div>
                <div class="right">
                    <img src="assets/img/img3.svg" alt="">
                </div>
            </div>       
        </section>

        <!-- login action="processamento/valida-login.php" -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" id="div-login">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 style="text-align:center;color: black;font-weight: 700;">Login</h3>
                        <div class="form-login">
                            <form id="login">
                                <input type="email" class="login" name="email_login" id="email_login" placeholder="Informe seu e-mail" required>
                                <br>
                                <input type="password" class="login" name="senha_login" id="senha_login" placeholder="Insira sua senha" required>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#senhaModal" style="text-decoration: none;"><p>Esqueci a senha</p></a>
                                <br>                          
                                <button type="submit" class="btn-login">Login</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:none;">
 
                    </div>
                </div>
            </div>
        </div>

        <!-- Cadastro api/login/index.php-->
        <div class="modal fade" id="cadModal" tabindex="-1" aria-labelledby="cadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" id="div-login">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 style="text-align:center;color: black;font-weight: 700;">Cadastro</h3>
                        <div class="form-login">
                            <form id="form-cad">
                                <input type="text" name="nome" class="login" id="nome" placeholder="Informe seu nome e sobrenome" required>
                                <br>
                                <input type="email" name="email" class="login" id="email" placeholder="Informe seu e-mail" required>
                                <br> 
                                <input type="password" name="senha" class="login" id="senha" placeholder="Insira sua senha" required>
                                <br>
                                <input type="password" name="confirmar" class="login" id="confirmar" placeholder="Insira sua senha novamente" required>
                                <br>                         
                                <button type="submit" class="btn-login">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:none;">
 
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="senhaModal" tabindex="-1" aria-labelledby="senhaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" id="div-login">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 style="text-align:center;color: black;font-weight: 700;">Esqueci a senha</h3>
                        <div class="form-login">
                            <form id="form_email_senha">                         
                                <input type="email" name="email_recuperar" class="login" id="email_recuperar" placeholder="Informe seu e-mail" required>
                                <br>                         
                                <button type="submit" class="btn-login">Recuperar</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:none;">
 
                    </div>
                </div>
            </div>
        </div>

        <!-- Rodapé-->
        <footer class="footer">
           <div class="bg-dark py-3">
                <div class="container px-4 px-lg-5">Copyright &copy; 2024 - Web Notes</div>
            </div>
        </footer>

        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/sweetalert2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <?php 
			if(!empty($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}else{

			}
		?>
        
        <script>

            const login = document.getElementById('login');

            if(login){
                login.addEventListener("submit",async (e) =>{
                
                    e.preventDefault();
                
                    const dadosForm = new FormData(login);

                    const dados = await fetch("http://localhost/webnotes/api/login/",{
                        method: "POST",
                        body: dadosForm
                    });
                
                    const resposta = await dados.json();
                    console.log(resposta);

                    if(resposta['status']){
                   
                        window.location = "inicio";

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
            const formCad = document.getElementById('form-cad');

            if(formCad){
                formCad.addEventListener("submit",async (e) =>{
                
                    e.preventDefault();
                
                    const dadosForm = new FormData(formCad);

                    const dados = await fetch("http://localhost/webnotes/api/usuario/",{
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

            const form_email_senha = document.getElementById('form_email_senha');

            if(form_email_senha){
                form_email_senha.addEventListener("submit",async (e) =>{
                
                    e.preventDefault();
                
                    const dadosForm = new FormData(form_email_senha);

                    const dados = await fetch("http://localhost/webnotes/api/senha/esqueci/",{
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
    </body>
</html>