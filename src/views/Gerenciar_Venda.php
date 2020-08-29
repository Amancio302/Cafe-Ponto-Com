<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("View.php");
    require_once("../controllers/VendaController.php");

    class Gerenciar_Venda extends View {

        function __construct () {
            $this->needAuth = true;
            $this->controller = new VendaController();
            $this->name = 'Gerenciar_Venda';
        }

        function getVenda () {
            $res =  $this->controller->getVenda($_GET["idVenda"]);
            return $res;
        }

        function deletarPedido ($idPedido) {
            echo 1;
            $res = $this->controller->deletarPedido($idPedido);
            if ($res) {
                echo "<script>alert('Pedido Excluido');</script>";
            } else {
                echo "<script>alert('Pedido nao pode ser excluido');</script>";
            }
            $this->redirect("Gerenciar_Venda", "idVenda=".$_GET["idVenda"]);
        }

        function cadastrarPedido ($idProduto, $qtd) {
            $res = $this->controller->createPedido($_GET["idVenda"], $idProduto, $qtd);
            if ($res) {
                echo "<script>alert('Pedido Cadastrado');</script>";
            } else {
                echo "<script>alert('Pedido não pode ser cadastrado');</script>";
            }
        }

        function fecharVenda ($transacao, $Valor_Pago) {
            $res = $this->controller->fecharVenda($_GET["idVenda"], $transacao, $Valor_Pago);
            if ($res) {
                echo "<script>alert('Venda fechada');</script>";
            } else {
                echo "<script>alert('Ocorreu um erro');</script>";
            }
            $this->redirect("Gerenciar_Vendas");
        }

        function getProdutos () {
            $res =  $this->controller->getProdutos();
            return $res;
        }

        function getPedidos () {
            $res =  $this->controller->getPedidos($_GET["idVenda"]);
            return $res;
        }
        function getProdutosHTML () {
            $Produtos = $this->getProdutos();
            $html = "";
            foreach($Produtos as $produto) {
                $html = $html."
                <option value=\"$produto->idProduto\">$produto->Nome</option>
                ";
            }
            return $html;
        }
        
        function getPedidosHTMl () {
            $Pedidos = $this->getPedidos();
            $html = "";
            foreach($Pedidos as $Pedido) {
                $produto = $Pedido->Produto;
                $html = $html . "
                        <div class=\"dropdown\">
                            <button
                                class=\"btn btn-secondary dropdown-toggle\"
                                type=\"button\"
                                id=\"dropdownMenuButton\"
                                data-toggle=\"dropdown\"
                                aria-haspopup=\"true\"
                                aria-expanded=\"false\"
                            >
                                $produto->Nome: $Pedido->qtdProduto unidades
                            </button>
                            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                <a href=\"./Editar_Pedido.php?idPedido=$Pedido->idPedido\">
                                <button
                                    type=\"button\"
                                    class=\"btn btn-warning dropdown-item\"
                                >
                                    Editar
                                </button>
                            <a class=\"dropdown-item\" href=\"./Gerenciar_Venda.php?idVenda=". $_GET["idVenda"] . "&delete=$Pedido->idPedido\">Excluir</a>
                            </div>
                        </div>
                ";
            }
            return $html;
        }

        function output () {
            $venda = $this->getVenda();
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
                        <main role=\"main\" class=\"main col-md-9 ml-sm-auto col-lg-10 px-md-4\">
                            <h1 class=\"welcome mt-3 mb-3\">Gerenciar Venda</h1>
                            <h4>Valor Total: R$".$venda->Valor_Total."</h4>
                            <button
                                type=\"button\"
                                class=\"btn mt-5 btn-warning flex-columns\"
                                data-toggle=\"modal\"
                                data-target=\"#exampleModal1\"
                                style=\"width: 250px;\"
                            >
                                Adicionar Pedido
                            </button>
                            <a>
                                <button
                                    type=\"button\"
                                    class=\"btn mt-5 btn-warning flex-columns\"
                                    data-toggle=\"modal\"
                                    data-target=\"#exampleModal2\"
                                    style=\"width: 250px;\"
                                >
                                    Concluir venda
                                </button>
                            </a>
                            <div
                                class=\"modal fade\"
                                id=\"exampleModal1\"
                                tabindex=\"-1\"
                                aria-labelledby=\"exampleModalLabel1\"
                                aria-hidden=\"true\"
                            >
                                <div class=\"modal-dialog\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <h5 class=\"modal-title\" id=\"exampleModalLabel1\">
                                                Novo pedido
                                            </h5>
                                            <button
                                                type=\"button\"
                                                class=\"close\"
                                                data-dismiss=\"modal\"
                                                aria-label=\"Close\"
                                            >
                                                <span aria-hidden=\"true\">&times;</span>
                                            </button>
                                        </div>
                                        <div class=\"modal-body\">
                                            <form action=\"./Gerenciar_Venda.php?idVenda=". $_GET["idVenda"] ."\" method=\"POST\">
                                                <div class=\"form-group\">
                                                    <label for=\"recipient-name\" class=\"col-form-label\"
                                                    >Nome do produto:</label
                                                    >
                                                    <select name=\"idProduto\" id=\"idProduto\" class=\"form-control\"
                                                    id=\"recipient-name\">".
                                                        $this->getProdutosHTML()
                                                    ."</select>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label for=\"recipient-name\" class=\"col-form-label\"
                                                    >Quantidade:</label
                                                    >
                                                    <input
                                                    type=\"number\"
                                                    name=\"qtdProduto\"
                                                    class=\"form-control\"
                                                    id=\"recipient-name\"
                                                    ></input>
                                                </div>
                                                <button
                                                    type=\"button\"
                                                    class=\"btn btn-secondary\"
                                                    data-dismiss=\"modal\"
                                                >
                                                    Descartar
                                                </button>
                                                <input type=\"submit\" class=\"btn btn-warning\" value=\"Salvar\">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class=\"modal fade\"
                                id=\"exampleModal2\"
                                tabindex=\"-1\"
                                aria-labelledby=\"exampleModalLabel1\"
                                aria-hidden=\"true\"
                            >
                                <div class=\"modal-dialog\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <h5 class=\"modal-title\" id=\"exampleModalLabel1\">
                                                Fechar pedido
                                            </h5>
                                            <button
                                                type=\"button\"
                                                class=\"close\"
                                                data-dismiss=\"modal\"
                                                aria-label=\"Close\"
                                            >
                                                <span aria-hidden=\"true\">&times;</span>
                                            </button>
                                        </div>
                                        <div class=\"modal-body\">
                                            <form action=\"./Gerenciar_Venda.php?idVenda=". $_GET["idVenda"] ."\" method=\"POST\">
                                                <div class=\"form-group\">
                                                    <label for=\"recipient-name\" class=\"col-form-label\"
                                                    >Valor Pago</label
                                                    >
                                                    <input
                                                        type=\"number\"
                                                        name=\"Valor_Pago\"
                                                        class=\"form-control\"
                                                        id=\"recipient-name\"
                                                    >
                                                </div>
                                                <div class=\"form-group\">
                                                    <label for=\"recipient-name\" class=\"col-form-label\"
                                                    >Quantidade:</label
                                                    >
                                                    <select name=\"transacao\" id=\"transacao\" class=\"form-control\"
                                                    id=\"recipient-name\">
                                                        <option value=\"1\">Dinheiro</option>
                                                        <option value=\"2\">Crédito</option>
                                                        <option value=\"3\">Débito</option>
                                                    </select>
                                                </div>
                                                <button
                                                    type=\"button\"
                                                    class=\"btn btn-secondary\"
                                                    data-dismiss=\"modal\"
                                                >
                                                    Descartar
                                                </button>
                                                <input type=\"submit\" class=\"btn btn-warning\" value=\"Salvar\">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"pt-3 pb-2 mb-3 d-flex flex-rows\">
                                <div class=\"row\">".
                                $this->getPedidosHTML()."
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

    $view = new Gerenciar_Venda();

    // Aqui testamos os POST e GETS da página renderizada

    if (isset($_GET["sair"])) {
        $view->sair();
    }

    if (isset($_POST["idProduto"])) {
        $view->cadastrarPedido($_POST["idProduto"], $_POST["qtdProduto"]);
    }

    if (isset($_POST["transacao"])) {
        $view->fecharVenda($_POST["transacao"], $_POST["Valor_Pago"]);
    }

    if (isset($_GET["idVenda"])) {
        if (isset($_GET["delete"])) {
            $view->deletarPedido($_GET["delete"]);
        }
        $view->render();
    }

    $view->redirect("./Gerenciar_Vendas");

?>