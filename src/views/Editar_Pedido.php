<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("View.php");
    require_once("../controllers/PedidoController.php");

    class Editar_Pedido extends View {

        function __construct () {
            $this->needAuth = true;
            $this->controller = new PedidoController();
            $this->name = 'Editar_Pedido';
        }

        function getProdutos () {
            $res =  $this->controller->getAllProdutos();
            return $res;
        }

        function getPedidos () {
            $res =  $this->controller->getAllPedidos($_GET["idVenda"]);
            return $res;
        }

        function getOnePedido ($idPedido) {
            $res =  $this->controller->getOnePedido($idPedido);
            return $res;
        }

        function getProdutosHTML () {
            $Produtos = $this->getProdutos();
            $html = "";
            foreach($Produtos as $produto) {
                $selected = $this->getOnePedido($_GET["idPedido"]);
                $html = $html."
                <option value=\"$produto->idProduto\"";
                if ($produto->idPedido == $selected->Produto->idPedido) {
                    $html = $html." selected=\"selected\"";
                }
                $html = $html.">$produto->Nome</option>
                ";
            }
            return $html;
        }

        function editarPedido ($idPedido, $idVenda, $idProduto, $qtd) {
            $Pedido = $this->getOnePedido($idPedido);
            $Pedido->qtdProduto = $qtd;
            $res = $this->controller->editarPedido($idPedido, $Pedido, $idProduto);
            if ($res) {
                echo "<script>alert('Sucesso')</script>";
            } else {
                echo "<script>alert('Falha')</script>";
            }
            $this->redirect("./Gerenciar_Venda", "idVenda=$idVenda");
        }
        
        function editarPedidoHTML ($idPedido) {
            $Pedido = $this->getOnePedido($idPedido);
            $produto = $Pedido->Produto;
            $venda = $Pedido->Venda;
            return "
            <div class=\"pt-3 pb-2 mb-3 d-flex flex-column\">
                <h1 class=\"welcome mb-3\">Editar Pedido</h1>

                <div class=\"row\">
                    <form method=\"Editar_Pedido.php\" method=\"GET\">
                        <input type=\"hidden\" name=\"idPedido\" value=\"$Pedido->idPedido\">
                        <input type=\"hidden\" name=\"idVenda\" value=\"$venda->idVenda\">
                        <div class=\"input-group mb-3 ml-2\" style=\"width: 100%\">
                            <label for=\"recipient-name\" class=\"col-form-label\"
                                >Nome do produto:</label
                            >
                            <select name=\"idProduto\" id=\"idProduto\" class=\"form-control\"
                            id=\"recipient-name\" value=\"".$produto->idProduto ."\">".
                                $this->getProdutosHTML()
                            ."</select>
                        </div>
                        <div class=\"input-group mb-3 ml-2\" style=\"width: 100%\">
                            <label for=\"recipient-name\" class=\"col-form-label\"
                                >Quantidade:</label
                            >
                            <input
                                type=\"number\"
                                class=\"form-control\"
                                id=\"recipient-name\"
                                name=\"qtdProduto\"
                                value=\"$Pedido->qtdProduto\"
                            ></input>
                        </div>
                        <a href=\"./Gerenciar_Venda.php?idVenda=".$venda->idVenda."\">
                        <button
                            type=\"button\"
                            class=\"btn btn-danger mt-2\"
                            style=\"width: 150px\"
                        >
                            Cancelar
                        </button>
                        </a>
                        <input
                            type=\"submit\"
                            class=\"btn btn-warning mt-2\"
                            style=\"width: 150px\"
                            value=\"Salvar\"
                        >
                    </form>
                </div>
            </div>   
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
            <meta
                name=\"author\"
                content=\"Mark Otto, Jacob Thornton, and Bootstrap contributors\"
            />
            <meta name=\"generator\" content=\"Jekyll v4.1.1\" />
            <title>Dashboard Template · Bootstrap</title>
        
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
                    <form action=\"Gerenciar_Venda.php\" method=\"GET\">
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
                                Cadastrar Venda
                                </a>
                            </li>".
                            $this->adminOption()
                        ."</ul>
                        <div class=\"rodape pt-2 pb-2 d-flex justify-content-center\">
                            Desenvolvido por JVM
                        </div>
                    </div>
                </nav>
                <main role=\"main\" class=\"main col-md-9 ml-sm-auto col-lg-10 px-md-4\">".
                  $this->editarPedidoHTML($_GET["idPedido"])  
                ."</main>
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

    $view = new Editar_Pedido();

    // Aqui testamos os POST e GETS da página renderizada

    if (isset($_GET["sair"])) {
        $view->sair();
    }

    if (isset($_GET["idVenda"])) {
        $view->editarPedido($_GET["idPedido"], $_GET["idVenda"], $_GET["idProduto"], $_GET["qtdProduto"]);
    }

    if (isset($_GET["idPedido"])) {
        $view->render();
    }

    $view->redirect("./Gerenciar_Vendas");

?>