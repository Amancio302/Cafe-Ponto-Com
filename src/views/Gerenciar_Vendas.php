<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("View.php");
    require_once("../controllers/VendaController.php");

    class Gerenciar_Vendas extends View {

        function __construct () {
            $this->needAuth = true;
            $this->controller = new VendaController();
            $this->name = 'Gerenciar_Vendas';
        }

        function cadastrarVenda () {
            $res = $this->controller->createVenda();
            $this->redirect("./Gerenciar_Venda", "idVenda=$res");
        }
        
        function getVendas () {
            return $this->controller->getAllVendas();
        }

        function  getVendasHTML () {
            $html = "";
            $Vendas = $this->getVendas();
            foreach($Vendas as $Venda) {
                $Usuario = $Venda->Usuario;
                $html = $html."
                
                    <a href=\"./Gerenciar_Venda.php?idVenda=$Venda->idVenda\">
                    <button
                        id=\"addPedido\"
                        type=\"button\"
                        class=\"btn btn-warning btn-lg btn-novo-pedido mt-3 ml-2 mr-2 flex-6\"
                    >
                        $Usuario->Nome<br>
                        R$$Venda->Valor_Total<br>
                        R$$Venda->Valor_Pago<br>";
                if ($Venda->Concluido)
                    $html = $html . "Concluída";
                else
                $html = $html . "Não concluída";
                $html = $html ."</button>
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
                    <meta
                        name=\"author\"
                        content=\"Mark Otto, Jacob Thornton, and Bootstrap contributors\"
                    />
                    <meta name=\"generator\" content=\"Jekyll v4.1.1\" />
                    <title>Gerenciar Vendas</title>
                
                    <!-- Bootstrap core CSS -->
                    <link href=\"../views/assets/dist/css/bootstrap.min.css\" rel=\"stylesheet\" />
                
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
                    <link href=\"../views/css/dashboard.css\" rel=\"stylesheet\" />
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
                            <form action=\"Gerenciar_Vendas.php\" method=\"GET\">
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
                                        <a class=\"nav-link pt-3 pb-3\" href=\"./Gerenciar_Produtos.php\">
                                            <span data-feather=\"edit\"></span>
                                            Gerenciar Produtos
                                        </a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a class=\"nav-link active pt-3 pb-3\" href=\"./Gerenciar_Vendas.php\">
                                        <span data-feather=\"plus-circle\"></span>
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
                                <h1 class=\"welcome mt-3 mb-3\">Gerenciar Vendas</h1>
                                <a href=\"./Gerenciar_Vendas.php?create=true\" class=\"mt-3 mb-3\">
                                    <button
                                        id=\"addPedido\"
                                        type=\"button\"
                                        class=\"btn btn-warning btn-lg mt-3\"
                                    >
                                        Cadastrar Venda
                                    </button>
                                </a>
                                <div class=\"pt-3 pb-2 mb-3 d-flex flex-rows\">
                                <div class=\"row\">
                                ".
                                    $this->getVendasHTML()
                                ."</div>
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
                    <script src=\"../views/assets/dist/js/bootstrap.bundle.min.js\"></script>
                    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js\"></script>
                    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js\"></script>
                    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
                    <script src=\"../views/js/dashboard.js\"></script>
                    </body>
                </html>       
            ";
        }
    }

    $view = new Gerenciar_Vendas();

    // Aqui testamos os POST e GETS da página renderizada

    if (isset($_GET["sair"])) {
        $view->sair();
    }

    if ($_GET["create"]) {
        $view->cadastrarVenda();
    }

    // Aqui renderizamos a página

    $view->render();
?>