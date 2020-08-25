<?php
session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Café Ponto Com</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="../views/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../views/css/login.css" rel="stylesheet">
  </head>
  <body class="text-center bg-image">
      <div class="row">
        <div class="offset-7 vertical-center" style="right:0px; vertical-align: middle;">
            <form class="form-signin bg-login" action="LoginController.php" method="POST">
            <img class="mb-4" src="../views/assets/elipse.png" alt="" width="72" height="72">

            <h1 class="mb-3 font-weight-normal" style="color:white;">Café Ponto Com</h1>

            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" name="inputEmail" id="inputEmail" class="form-control md-2" placeholder="Email" required autofocus>

            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" name="inputPassword" id="inputPassword" class="form-control mt-2" placeholder="Senha" required>

            <button class="btn btn-lg btn-cafe btn-block md-5" type="submit">Entrar</button>

            <a class="mt-5"  style="color:white;">É novo por aqui ? Cadastre-se</a>

            <p class="mt-2 mb-3 text-muted">&copy; 2020</p> 
            </form>
        </div>
      </div> 
    
</form>
</div>
</body>
</html>
