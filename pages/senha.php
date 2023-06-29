<?php 

    session_start();

    $msg = "<script> Swal.fire({text: 'Erro: Link inválido',icon: 'error',showCancelButton: false,confirmButtonColor: '#3085d6',confirmButtonText: 'Fechar'}); </script>";
    // se as sessões não existirem 
    if((!isset($_GET['chave']))){
        $_SESSION['msg'] = $msg;
        header("Location: /webnotes");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar senha</title>
        <link rel="icon" type="image/x-icon" href="assets/img/logo.svg" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="assets/css/estilo.css?15" rel="stylesheet">
    </head>
    <body>

        <section class="senha">
            <div class="senha_nova">
                <h3 style="text-align:center;color: black;font-weight: 700;">Alterar Senha</h3>
                <div class="form-login">
                    <form id="senha_nova">
                        <input type="hidden" class="login" name="email" id="email" value="<?php echo $_GET['chave'];?>" placeholder="" required>
                        <br>
                        <input type="password" class="login" name="senha" id="senha" placeholder="Informe sua nova senha" required>
                        <br>
                        <input type="password" class="login" name="senha_confirmar" id="senha_confirmar" placeholder="Insira novamente sua senha" required>
                        <br>                          
                        <button type="submit" class="btn-login">Alterar</button>
                    </form>
                </div>
            </div>
        </section>

        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/sweetalert2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
         
        <script>
            const formCad = document.getElementById('senha_nova');

            if(formCad){
                formCad.addEventListener("submit",async (e) =>{
                
                    e.preventDefault();
                
                    const dadosForm = new FormData(formCad);

                    const dados = await fetch("http://localhost:81/webnotes/api/senha/recuperar/",{
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
                                window.location = "home";
                            }else{
                                window.location = "home";           
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