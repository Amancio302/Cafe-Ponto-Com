<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("View.php");
    require_once("../controllers/ProdutoController.php");

    class Editar_Produto extends View {
        
        function __construct () {
            $this->needAuth = true;
            $this->controller = new ProdutoController();
            $this->name = 'Editar_Produto';
            $this->editId = null;
        }

        function getProduto ($idProduto) {
            return $this->controller->getOneProduto($idProduto);
        }

        function editarProdutoHTML () {
            $produto = $this->getProduto($_GET["idProduto"]);
            $idUser = $produto->addedBy->idUsuario;
            return "
                <form action=\"Gerenciar_Produtos.php\" method=\"POST\">
                    <input type=\"hidden\" name=\"idProduto\" value=\"$produto->idProduto\">
                    <input type=\"hidden\" name=\"addedBy\" value=\"$idUser\">
                    <div class=\"input-group mb-3 ml-2\" style=\"width: 100%\">
                        <label for=\"recipient-name\" class=\"col-form-label\">
                            Nome do produto:
                        </label>
                        <input type=\"text\" name=\"Nome\" value=\"$produto->Nome\">
                    </div>
                    <div class=\"input-group mb-3 ml-2\" style=\"width: 100%\">
                        <label for=\"recipient-name\" class=\"col-form-label\">
                            Descrição do produto:
                        </label>
                        <input type=\"text\" name=\"Descricao\" value=\"$produto->Descricao\">
                    </div>
                    <div class=\"input-group mb-3 ml-2\" style=\"width: 100%\">
                        <label for=\"recipient-name\" class=\"col-form-label\">
                            Preço:
                        </label>
                        <input type=\"number\" name=\"Preco\" value=\"$produto->Preco\" step=\"0.01\">
                    </div>
                    <div class=\"input-group mb-3 ml-2\" style=\"width: 100%\">
                        <label for=\"recipient-name\" class=\"col-form-label\">
                            Quantidade:
                        </label>
                        <input type=\"number\" name=\"Quantidade\" value=\"$produto->Quantidade\">
                    </div>
                    <input type=\"submit\" value=\"Enviar\">
                    <a href=\"Gerenciar_Produtos.php\">
                        <button type=\"button\">Cancelar</button>
                    </a>
                </form>
            ";
        }

        function output () {
            return "
            <html lang=\"en\">
                <head>
                    <meta charset=\"utf-8\" />
                    <meta
                    name=\"viewport\"
                    content=\"width=device-width, initial-scale=1, shrink-to-fit=no\"
                    />
                    <meta name=\"description\" content=\"\" />
                    <title>Gerenciar Produtos · Bootstrap</title>
                
                    <!-- Bootstrap core CSS -->
                    <link href=\"../views/css/bootstrap.min.css\" rel=\"stylesheet\" />
                
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
                    <link href=\"../views/css/gerenciarProdutos.css\" rel=\"stylesheet\" />
                </head>
                <body>
                    <nav class=\"navbar sticky-top bg-dark flex-md-nowrap p-0 shadow\">
                        <a class=\"navbar-brand col-md-3 col-lg-2 mr-0 px-3\" href=\"#\"
                            >Café Ponto Com</a
                        >
                        <button
                            class=\"navbar-toggler position-absolute d-md-none collapsed\"
                            type=\"button\"
                            data-toggle=\"collapse\"
                            data-target=\"#sidebarMenu\"
                            aria-controls=\"sidebarMenu\"
                            aria-expanded=\"false\"
                            aria-label=\"Toggle navigation\"
                        >
                            <span class=\"navbar-toggler-icon\"></span>
                        </button>
                        <ul class=\"navbar-nav px-3\">
                            <li class=\"nav-item text-nowrap\">
                                <form action=\"Gerenciar_Produto.php\" method=\"GET\">
                                    <input type=\"hidden\" name=\"sair\" value=\"true\">
                                    <input type=\"submit\" class=\"nav-link\" style=\"border: 0; background: transparent\" value=\"Sair\">
                                </form>
                            </li>
                        </ul>
                    </nav>
                    <div class=\"container-fluid\">
                        <div class=\"row\">
                            <nav
                                id=\"sidebarMenu\"
                                class=\"col-md-3 col-lg-2 d-md-block bg-light sidebar collapse\"
                            >
                                <div class=\"sidebar-sticky\">
                                    <ul class=\"nav flex-column\">
                                        <li class=\"nav-item\">
                                            <a class=\"nav-link pt-3 pb-3\" href=\"./Dashboard.php\">
                                            <span data-feather=\"home\"></span>
                                            Menu Principal <span class=\"sr-only\"></span>
                                            </a>
                                        </li>
                                        <li class=\"nav-item\">
                                            <a class=\"nav-link pt-3 pb-3\" href=\"./Cadastrar_Produto.php\">
                                                <span data-feather=\"plus-circle\"></span>
                                                Cadastrar Produto
                                            </a>
                                        </li>
                                        <li class=\"nav-item\">
                                            <a class=\"nav-link active pt-3 pb-3\" href=\"./Gerenciar_Produtos.php\">
                                                <span data-feather=\"edit\"></span>
                                                Gerenciar Produtos
                                            </a>
                                        </li>
                                        <li class=\"nav-item\">
                                            <a class=\"nav-link pt-3 pb-3\" href=\"./Gerenciar_Vendas.php\">
                                            <span data-feather=\"edit\"></span>
                                            Gerenciar Vendas
                                            </a>
                                        </li>".
                                        $this->adminOption()
                                    ."</ul>
                                    <div class=\"rodape pt-2 pb-2 d-flex justify-content-center\">
                                        Desenvolvido por JVM
                                    </div>
                                </div>
                            </nav>
                            <main role=\"main\" class=\"main col-md-9 ml-sm-auto col-lg-10 px-md-4\">
                                <div class=\"pt-3 pb-2 mb-3 d-flex flex-column\">
                                    <h1 class=\"welcome mb-3\">Editar Produto</h1>".
                                    $this->editarProdutoHTML()  
                                ."</div>
                            </main>
                        </div>
                    </div>
                    <script
                    src=\"https://code.jquery.com/jquery-3.5.1.slim.min.js\"
                    integrity=\"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj\"
                    crossorigin=\"anonymous\"
                    ></script>
                    <script>
                    window.jQuery ||
                        document.write(
                        '<script src=\"../assets/js/vendor/jquery.slim.min.js\"><\/script>'
                        );
                    var cont = 0;
                    document.getElementById(\"contador\").innerHTML = cont;
                    function acrescentar() {
                        cont++;
                        document.getElementById(\"contador\").innerHTML = cont;
                    }
                    function decrescer() {
                        cont > 0 ? cont-- : (cont = 0);
                        document.getElementById(\"contador\").innerHTML = cont;
                    }
                    </script>
                    <script src=\"../views/js/bootstrap.bundle.min.js\"></script>
                    <script type=\"text/javascript\" src=\"../views/js/bootstrap.min.js\"></script>
                    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js\"></script>
                    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js\"></script>
                    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
                    <script src=\"../views/js/dashboard.js\"></script>
                
                </body>
            </html>     
            ";
        }
    }

    $view = new Editar_Produto();

    // Aqui testamos os POST e GETS da página renderizada

    if (isset($_GET["sair"])) {
        $view->sair();
    }

    // Aqui renderizamos a página

    $view->render();
?>