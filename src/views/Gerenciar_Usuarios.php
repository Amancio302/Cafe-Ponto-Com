<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once("View.php");
    require_once("../controllers/UsuarioController.php");

    class Gerenciar_Usuarios extends View {

        function __construct () {
            $this->needAuth = true;
            $this->controller = new UsuarioController();
            $this->name = 'Gerenciar_Usuarios';
        }

        function deleteUsuario($idUsuario) {
            $res = $this->controller->deleteUsuario($idUsuario);
            if ($res) {
                echo "<script>alert('Usuario Excluído')</script>";
            } else {
                echo "<script>alert('Usuario não pode ser excluído')</script>";
            }
        }

        function promoveUsuario($idUsuario) {
            $res = $this->controller->promoveUsuario($idUsuario);
            if ($res) {
                echo "<script>alert('Usuario promovido')</script>";
            } else {
                echo "<script>alert('Usuario não pode ser promovido')</script>";
            }
        }

        function getUsuarios () {
            return $this->controller->getAllUsuarios();
        }

        function getUsuariosHTML () {
            $html = "";
            $Usuarios = $this->getUsuarios();
            foreach($Usuarios as $Usuario) {
                $html = $html."
                <div class=\"dropdown col-lg-6 mt-2\">
                    <button class=\"btn btn-default dropdown-toggle btn-produto\" type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                        Nome : $Usuario->Nome<br>
                        Email : $Usuario->Email<br>
                        Endereço : $Usuario->Endereco<br>
                        CPF : $Usuario->CPF<br>
                        Telefone : $Usuario->Telefone<br> 
                        Comissão : $Usuario->Valor_Comissao%<br>
                        <span class=\"caret\"></span>
                    </button>
                    <ul class=\"dropdown-menu\" style=\"color:#ffefc7\" aria-labelledby=\"dropdownMenu1\">
                        <li>
                            <form action=\"Gerenciar_Usuarios.php\" method=\"POST\">
                                <input type=\"hidden\" name=\"idDelete\" value=\"$Usuario->idUsuario\">
                                <input style=\"border: 0; background: transparent;\" class=\"drop-edit\" type=\"submit\" value=\"Excluir\">
                            </form>";
                if (!$Usuario->Admin) {
                    $html = $html."<form action=\"Gerenciar_Usuarios.php\" method=\"POST\">
                                <input type=\"hidden\" name=\"idPromove\" value=\"$Usuario->idUsuario\">
                                <input style=\"border: 0; background: transparent;\" class=\"drop-edit\" type=\"submit\" value=\"Promover a admin\">
                            </form>";
                }
                $html = $html."
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
                        <title>Cadastrar Produto · Bootstrap</title>
                    
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
                        <link href=\"../views/css/gerenciarUsuarios.css\" rel=\"stylesheet\" />
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
                                    <form action=\"Gerenciar_Usuarios.php\" method=\"GET\">
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
                                                <a class=\"nav-link pt-3 pb-3\" href=\"./Cadastrar_Venda.php\">
                                                <span data-feather=\"plus-circle\"></span>
                                                Cadastrar Venda
                                                </a>
                                            </li>
                                            <li class=\"nav-item\">
                                                <a class=\"nav-link pt-3 pb-3\" href=\"./Gerenciar_Vendas.php\">
                                                <span data-feather=\"edit\"></span>
                                                Gerenciar Vendas
                                                </a>
                                            </li>
                                            <li class=\"nav-item\">
                                                <a class=\"nav-link active pt-3 pb-3\" href=\"./Gerenciar_Usuarios.php\">
                                                <span data-feather=\"coffee\"></span>
                                                Gerenciar Usuarios
                                                </a>
                                            </li>
                                        </ul>
                                        <div class=\"rodape pt-2 pb-2 d-flex justify-content-center\">
                                            Desenvolvido por JVM
                                        </div>
                                    </div>
                                </nav>
                                <main role=\"main\" class=\"main col-md-9 ml-sm-auto col-lg-10 px-md-4\">
                                    <div class=\"pt-3 pb-2 mb-3 d-flex flex-column\">
                                        <h1 class=\"welcome mb-3\">Gerenciar Usuários</h1>

                                        <div class=\"row\">".
                                        $this->getUsuariosHTML()
                                        ."</div>
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

    $view = new Gerenciar_Usuarios();

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
      }

    // Aqui testamos os POST e GETS da página renderizada

    if (isset($_GET["sair"])) {
        $view->sair();
    }

    console_log($_POST);

    if(isset($_POST['idDelete'])) {
        $view->deleteUsuario($_POST['idDelete']);
    }

    if(isset($_POST['idPromove'])) {
        $view->promoveUsuario($_POST['idPromove']);
    }

    // Aqui renderizamos a página

    $view->render();
?>