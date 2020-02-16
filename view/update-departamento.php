
<?php
include '../controller/conexao/conexao.php';
session_start();
if (empty($_SESSION['admin'])):
    header('location:../index.html');
endif;
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Tramitação de processos</title>
        <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
        <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
        <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
        <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/lib/helper.css" rel="stylesheet">
        <link href="assets/css/lib/toastr/toastr.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body>

        <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
            <div class="nano">
                <div class="nano-content">
                    <ul>
                        <div class="logo">
                            <a href="#">
                                <span>Gestor de Tramitação</span>
                                <br>
                                <span>de Processos</span>
                            </a>
                        </div>
                        <li class="label">Departamentos</li>
                        <li><a class="sidebar-sub-toggle"><i class="ti-home"></i>Departamento<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="add-departamento.php">Add Departamento</a></li>
                                <li><a href="lista-departamento.php">Lista de Departamento</a></li>
                            </ul>
                        </li>

                        <li class="label">Secretaria</li>
                        <li><a class="sidebar-sub-toggle"><i class="ti-book"></i> Funcionário <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="invoice.html"></a></li>
                                <li><a href="invoice-editable.html"> Lista de Funcionário</a></li>
                            </ul>
                        </li>

                        <li class="label">Processos</li>
                        <li><a class="sidebar-sub-toggle">
                                <i class="ti-bookmark"></i>Processos Gerais<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>          
                                <li><a href="page-reset-password.html">Lista de Processos</a></li>
                            </ul>
                            <ul>          
                                <li><a href="lista-processo-enviado-admin.php">Monitoramento de Processos</a></li>
                            </ul>
                        </li>
                        <li><a class="sidebar-sub-toggle">
                                <i class="ti-bookmark"></i>Admin<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="perfil-admin.php">Meu Perfil</a></li>
                            </ul>
                        </li>

                        <li><a  href="logout.php?funcao=sair"><i class="ti-close"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-left">
                            <div class="hamburger sidebar-toggle">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="dropdown dib">
                                <div class="header-icon" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <div class="drop-down dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-content-heading">
                                            <span class="text-left">Recent Notifications</span>
                                        </div>
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Mr. John</div>
                                                            <div class="notification-text">5 members joined today </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Mariam</div>
                                                            <div class="notification-text">likes a photo of you</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Tasnim</div>
                                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Mr. John</div>
                                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="text-center">
                                                    <a href="#" class="more-link">See All</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown dib">
                                <div class="header-icon" data-toggle="dropdown">
                                    <i class="ti-email"></i>
                                    <div class="drop-down dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-content-heading">
                                            <span class="text-left">2 New Messages</span>
                                            <a href="email.html">
                                                <i class="ti-pencil-alt pull-right"></i>
                                            </a>
                                        </div>
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li class="notification-unread">
                                                    <a href="#">
                                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/1.jpg" alt="" />
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Michael Qin</div>
                                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="notification-unread">
                                                    <a href="#">
                                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg" alt="" />
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Mr. John</div>
                                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Michael Qin</div>
                                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg" alt="" />
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Mr. John</div>
                                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="text-center">
                                                    <a href="#" class="more-link">See All</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $conexao = new conexao();
                            $nome = "";
                            $email = "";
                            $senha = "";

                            $query = $conexao->getconexao()->prepare("select * from admin");
                            $query->execute();
                            while ($row = $query->fetch(PDO::FETCH_ASSOC)):
                                $nome = $row['nome'];
                                $email = $row['email'];
                                $senha = $row['senha'];
                            endwhile;
                            ?>

                            <div class="dropdown dib">
                                <div class="header-icon" data-toggle="dropdown">
                                    <span class="user-avatar">
                                        <?php
                                        echo $nome;
                                        ?>

                                        <i class="ti-angle-down f-s-10">
                                        </i>
                                    </span>
                                    <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right" style="z-index: 9999;">
                                        <div class="dropdown-content-heading">
                                            <span class="text-left">Admin Activo
                                            </span>
                                        </div>
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <i class="ti-user"></i>
                                                        <span>
                                                            <?php echo $nome; ?>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ti-email"></i>
                                                        <span> <?php echo $email; ?></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 p-r-0 title-margin-right">
                            <div class="page-header">
                                <div class="page-title">
                                    <h1>Atualizando o Departamento:<?php echo $_GET['nome'] ?><span> >>> <a href="admin-page.php">Pagina Inicial</a></span></h1>
                                </div>

                                <div class="page-title text-center container-fluid " style="padding-left:300px;">
                                    <?php
                                    if (isset($_GET['message'])):
                                        if (!empty($_GET['message'])):
                                            if ($_GET['message'] == '1'):
                                                echo '<span style="font-size:18px; color:green;text-align:center! important;"> Departamento Atualizado Com Sucesso!</span>';
                                            endif;
                                            if ($_GET['message'] == '-1'):
                                                echo '<span style="font-size:18px; color:orange; text-align:center;"> Este Departamento ja Existe!</span>';
                                            endif;
                                            if ($_GET['message'] == '-2'):
                                                echo '<span style="font-size:18px; color:orange ;text-align:center;"> Este Usuario ja foi cadastrado num Departamento!</span>';
                                            endif;
                                            if ($_GET['message'] == '-3'):
                                                echo '<span style="font-size:18px; color:orange ;text-align:center;"> Este Email ja foi cadastrado num Departamento!</span>';
                                            endif;

                                        endif;

                                    endif;
                                    ?> 
                                </div>
                            </div>
                        </div>


                        <?php
                        $conexao = new conexao();
                        $queries = $conexao->getconexao()->prepare('select * from departamento where Id_Departamento=:id');
                        $queries->execute(array(
                            ':id' => $_GET['id']
                        ));

                        while ($linha = $queries->fetch()):

                            // departamento
                            $nome = $linha['Nome'];
                            $email =$linha['Email'];
                            $usuario = $linha['Usuario'];
                        // fim do departamento

                        endwhile;
                        ?>
                    </div>
                    <!-- /# row -->
                    <section id="main-content">
                        <form  method="POST"  action="../modal/admin-setting.php?funcao=update&&id=<?php echo $_GET['id'] ?>">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                <p class="text-muted m-b-15 f-s-12">Nome do Departamento</p>
                                                <input type="text" class="form-control input-flat" value="<?php echo $nome ?>"name="nome" required="">
                                            </div>
                                            <div class="form-group">
                                                <p class="text-muted m-b-15 f-s-12">Usuario</p>
                                                <input type="text" class="form-control input-flat" value="<?php echo $usuario ?>"name="usuario" required="">
                                            </div> 
                                            <div class="form-group">
                                                <p class="text-muted m-b-15 f-s-12">Email</p>
                                                <input type="text" class="form-control input-flat" value="<?php echo $email ?>"name="email" required="">
                                            </div>               
                                            <div class="col-lg-12">
                                                <input type="submit" class="btn btn-primary btn-block m-b-10"   value="Atualizar" />               
                                            </div>
                                        </div>
                                        <!-- /# card -->

                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <!-- jquery vendor -->
        <script src="assets/js/lib/jquery.min.js"></script>
        <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="assets/js/lib/menubar/sidebar.js"></script>
        <script src="assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="assets/js/lib/toastr/toastr.min.js"></script>
        <script src="assets/js/lib/toastr/toastr.init.js"></script>
        <script src="assets/js/lib/bootstrap.min.js"></script><script src="assets/js/scripts.js"></script>
        <!-- bootstrap -->

        <script src="assets/js/lib/calendar-2/moment.latest.min.js"></script>
        <script src="assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
        <script src="assets/js/lib/calendar-2/pignose.init.js"></script>


        <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
        <script src="assets/js/lib/weather/weather-init.js"></script>
        <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
        <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
        <script src="assets/js/lib/chartist/chartist.min.js"></script>
        <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
        <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
        <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
        <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
        <!-- scripit init-->
        <script src="assets/js/dashboard2.js"></script>
    </body>

</html>
