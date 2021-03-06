<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("View.php");
    require_once("../controllers/ProdutoController.php");

    class Gerenciar_Produtos extends View {
        
        function __construct () {
            $this->needAuth = true;
            $this->controller = new ProdutoController();
            $this->name = 'Gerenciar_Produtos';
            $this->editId = null;
        }

        function deleteProduto($idProduto) {
            $res = $this->controller->deleteProduto($idProduto);
            if ($res) {
                echo "<script>alert('Produto Excluído')</script>";
            } else {
                echo "<script>alert('Produto não pode ser excluído')</script>";
            }
        }

        function editarProduto ($idProduto, $Nome, $Descricao, $Preco, $Quantidade, $addedBy) {
            $res = $this->controller->editarProduto($idProduto, $Nome, $Descricao, $Preco, $Quantidade, $addedBy);
            if ($res) {
                echo "<script>alert('Produto modificado')</script>";
            } else {
                echo "<script>alert('Produto não pode ser modificado')</script>";
            }
        }

        function getProdutos () {
            return $this->controller->getAllProdutos();
        }

        function getProdutosHTML () {
            $html = "";
            $produtos = $this->getProdutos();
            foreach($produtos as $produto) {
                $html = $html."
                    <div class=\"dropdown col-lg-6 mt-2\">
                        <button class=\"btn btn-default dropdown-toggle btn-produto\" type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                            <span class=\"caret\">$produto->Nome</span>
                            <br>
                            <span class=\"caret\">Quantidade: $produto->Quantidade</span>
                        </button>
                        <ul class=\"dropdown-menu\" style=\"color:#ffefc7\" aria-labelledby=\"dropdownMenu1\">
                            <li>
                                <a href=\"Gerenciar_Produtos.php?deleteId=$produto->idProduto\">
                                    <btn
                                        class=\"drop-edit\" style=\"border: 0; background: transparent;\"
                                    >
                                        Excluir
                                    </btn>
                                </a>
                            </li>
                            <li>
                                <a class=\"drop-edit\" href=\"Editar_Produto.php?idProduto=$produto->idProduto\">
                                    <btn
                                        class=\"drop-edit\" style=\"border: 0; background: transparent;\"
                                    >
                                        Editar
                                    </btn>        
                                </a>
                            </li>
                        </ul>
                    </div>
                ";
            }
            return $html;
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
                                    <h1 class=\"welcome mb-3\">Gerenciar Produtos</h1>
                                    <div class=\"row\">".
                                        $this->getProdutosHTML()
                                    ."</div>
                                    <form action=\"Gerenciar_Produtos.php\" method=\"GET\">
                                        <input type=\"hidden\" name=\"cadastrar\" value=\"true\">
                                        <input type=\"submit\" value=\"Cadastrar Novo Produto\"
                                            id=\"addPedido\"
                                            type=\"button\"
                                            class=\"btn btn-warning btn-lg btn-novo-pedido mt-3\"
                                            data-toggle=\"modal\"
                                            data-target=\"#myModal\"    
                                        >
                                    </form>
                                </div>
                                </div>
                            </div>
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

    $view = new Gerenciar_Produtos();

    // Aqui testamos os POST e GETS da página renderizada

    if (isset($_GET["sair"])) {
        $view->sair();
    }

    if(isset($_GET['deleteId'])) {
        $view->deleteProduto($_GET['deleteId']);
    }

    if(isset($_GET['cadastrar'])) {
        $view->redirect("Cadastrar_Produto");
    }

    if(isset($_POST["idProduto"])) {
        $view->editarProduto($_POST["idProduto"], $_POST["Nome"], $_POST["Descricao"], $_POST["Preco"], $_POST["Quantidade"], $_POST["addedBy"]);
    }

    // Aqui renderizamos a página

    $view->render();
?>