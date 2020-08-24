<?php
session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Mark Otto, Jacob Thornton, and Bootstrap contributors"
    />
    <meta name="generator" content="Jekyll v4.1.1" />
    <title>Dashboard Template · Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../views/css/bootstrap.min.css" rel="stylesheet" />

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
    <link href="../views/css/cadastrarProduto.css" rel="stylesheet" />
  </head>
  <body>
    <nav class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"
        >Café Ponto Com</a
      >
      <button
        class="navbar-toggler position-absolute d-md-none collapsed"
        type="button"
        data-toggle="collapse"
        data-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <form action="DashboardController.php" method="GET">
                <?php
                    echo '<input type="hidden" name="id" value="';
                    echo $_SESSION["user"];
                    echo '">';
                ?>
                <input type="submit" class="nav-link" value="Sair">
            </form>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav
          id="sidebarMenu"
          class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
        >
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link pt-3 pb-3" href="#">
                  <span data-feather="home"></span>
                  Menu Principal <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pt-3 pb-3" href="#">
                  <span data-feather="plus-circle"></span>
                  Novo Produto
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pt-3 pb-3" href="#">
                  <span data-feather="edit"></span>
                  Gerenciar Pedidos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active pt-3 pb-3" href="#">
                  <span data-feather="plus-circle"></span>
                  Cadastrar Produtos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pt-3 pb-3" href="#">
                  <span data-feather="coffee"></span>
                  Gerenciar Produtos
                </a>
              </li>
            </ul>
            <div class="rodape pt-2 pb-2 d-flex justify-content-center">
              Desenvolvido por JVM
            </div>
          </div>
        </nav>
        <main role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="pt-3 pb-2 mb-3 d-flex flex-column">
                <h1 class="welcome mb-3">Cadastrar Novo Produto</h1>
            <form action="CadastrarProdutoController.php" method="POST">
                <div class="form-group col-lg-5" style="padding-left:0px;">
                    <label class="label-cafe" for="nomeProduto">Nome do Produto</label>
                    <input name="nomeProduto" class="form-control" placeholder="Nome do Produto" type="text">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label class="label-cafe" for="descricaoProduto">Descrição do Produto</label>
                    <input name="descricaoProduto" class="form-control" placeholder="Descrição" type="text">
                </div> <!-- form-group// -->
                <div class="form-group col-lg-4" style="padding-left:0px;">
                    <label class="label-cafe"  for="precoProduto">Preço do Produto</label>
                    <input name="precoProduto" class="form-control" placeholder="Preço" type="money">
                </div> <!-- form-group// --> 

                <input
                type="submit"
                class="btn btn-warning btn-lg btn-novo-pedido mt-3"
                data-toggle="modal"
                data-target="#myModal"
                value="Cadastrar Produto"
                >
            </form>
          </div>
        </main>
      </div>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script>
      window.jQuery ||
        document.write(
          '<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>'
        );
      var cont = 0;
      document.getElementById("contador").innerHTML = cont;
      function acrescentar() {
        cont++;
        document.getElementById("contador").innerHTML = cont;
      }
      function decrescer() {
        cont > 0 ? cont-- : (cont = 0);
        document.getElementById("contador").innerHTML = cont;
      }
    </script>
    <script src="../views/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../views/js/dashboard.js"></script>
  </body>
</html>
