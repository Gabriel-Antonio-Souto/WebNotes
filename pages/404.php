<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página não encontrada!</title>
        <link rel="icon" type="image/x-icon" href="http://localhost/www/crud/assets/img/logo.svg" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        /* Reset */
        *{
            margin: 0;
            font-family: 'Poppins',"Merriweather Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        body *{
            box-sizing: border-box;
        }

        /* Barra de rolagem */
        body::-webkit-scrollbar {
            width: 12px;
        }
        body::-webkit-scrollbar-track {
            background: transparent;
        }
        body::-webkit-scrollbar-thumb {
            background-color: rgb(71, 71, 73);
            border: 3px solid transparent;
        }

        /* 404 */
        .not_found{
            position: fixed;
            background-color: #212529;
            z-index: 5;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #not_found{
            width: 100vw;
            height: 100vh;
        }
    </style>
    <body>

        <div class="not_found"><img src="http://localhost/webnotes/assets/img/404.svg" id="not_found"></div>
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>