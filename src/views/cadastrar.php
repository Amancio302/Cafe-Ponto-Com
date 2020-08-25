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
<link href="css/bootstrap.min.css" rel="stylesheet">

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
    <link href="css/cadastrar.css" rel="stylesheet">
  </head>
  <body class="text-center bg-image">
      <div class="row">
        <div class="offset-6 vertical-center" style="right:0px;">
            <form class="form-signin bg-login" style="vertical-align: middle;" action="CadastrarUsuarioController.php" method="POST">
                <img class="mb-4" src="assets/elipse.png" alt="" width="72" height="72">

                <h2 class="mb-3 font-weight-normal" style="color:white;">Cadastrar</h2>

                    <div class="form-row">
                        <div class="col form-group">  
                            <input name="inputNomeCadastro" type="text" class="form-control" placeholder="Nome">
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <input name="inputSobrenomeCadastro" type="text" class="form-control" placeholder="Sobrenome">
                        </div> <!-- form-group end.// -->
                    </div>

                    <div class="form-group input-group ">
                        <input name="inputEmailCadastro" class="form-control" placeholder="Email" type="email">
                    </div> <!-- form-group// -->
                    <div class="form-row">
                        <div class="col form-group">  
                              <input name="inputCpf" type="text" class="form-control" placeholder="CPF">
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                              <input name="inputDataNasc"type="date" class="form-control" placeholder="Data Nascimento">
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row end.// -->
                    <div class="form-group input-group">
                        <input name="senhaCadastro" class="form-control" placeholder="Senha" type="password">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <input name="confirmarSenhaCadastro" class="form-control" placeholder="Confirmar Senha" type="password">
                    </div> <!-- form-group// -->                                                                                                           
                <button class="btn btn-lg btn-cafe btn-block" type="submit">Entrar</button>
                <p class="text-center mt-2" style="color:white;">Já tem uma conta? <a href="">Log In</a> </p> 
                <p class="text-muted">&copy; 2020</p> 
            </form>
        </div>
      </div> 
    
</form>
</div>
</body>
</html>
