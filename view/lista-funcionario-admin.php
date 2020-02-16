
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
                        <li><a class="sidebar-sub-toggle"><i class="ti-home"></i>Gerir Departamento<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="add-departamento.php">Adicionar Departamento</a></li>
                                <li><a href="lista-departamento.php">Lista de Departamento</a></li>
                            </ul>
                        </li>

                        <li class="label">Secretaria</li>
                        <li><a class="sidebar-sub-toggle"><i class="ti-book"></i>Gerir Funcionário <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul> 
                               <li><a href="lista-funcionario-admin.php"> Lista de Funcionário</a></li>
                            </ul>
                        </li>

                        <li class="label">Processos</li>
                        <li><a class="sidebar-sub-toggle">
                                <i class="ti-bookmark"></i>Processos Gerais<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>          
                                <li><a href="lista-processo-admin.php">Lista de Processos</a></li>
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

                        <li><a  href="logout.php?funcao=sair"><i class="ti-close"></i>Sair</a></li>
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
                                    <h1>Lista de Funcionário<span> >>> <a href="admin-page.php">Pagina Inicial</a></span></h1>
                                </div>

                                <div class="page-title text-center container-fluid " style="padding-left:300px;">
                                    <?php
                                    if (isset($_GET['message'])):
                                        if (!empty($_GET['message'])):
                                            if ($_GET['message'] == '1'):
                                                echo '<span style="font-size:18px; color:green;text-align:center! important;"> Departamento Cadastrado Com Sucesso!</span>';
                                            endif;
                                            if ($_GET['message'] == '-1'):
                                                echo '<span style="font-size:18px; color:orange; text-align:center;"> Este Departamento ja Existe!</span>';
                                            endif;
                                            if ($_GET['message'] == '-2'):
                                                echo '<span style="font-size:18px; color:orange ;text-align:center;"> Este Usuario ja foi cadastrado num Departamento!</span>';
                                            endif;

                                        endif;

                                    endif;
                                    ?> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Funcionario</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome</th>
                                                    <th>Apelido</th>
                                                    <th>Sexo</th>
                                                    <th>Telefone</th>
                                                    <th>Endereço</th> 
                                                    <th>Email</th>
                                                    <th>Senha</th> 
                                                    <th>Função</th>
                                                    <th>Departamento</th>
                                                    <th></th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                
                                                function busca_departamento($id){
                                                      $conexao= new conexao();
                                                      $queries =  $conexao->getconexao()->prepare('select * from departamento where Id_Departamento=:id');
                                                      $queries->execute(
                                                           Array(
                                                                ":id"=>$id
                                                           )
                                                           );
                                                      for(;$row =  $queries->fetch();):
                                                            return $row['Nome'];
                                                      endfor; 
                                                }

                                                   

                                                $index = 0;
                                                $queries = $conexao->getconexao()->prepare('select * from funcionario');
                                                $queries->execute();
                                                if ($queries->rowCount() != 0):
                                                    while ($key = $queries->fetch()):
                                                        $id = $key['ID_funcionario'];
                                                        echo '<tr>';
                                                        echo '<td>' . ++$index . '</td>';
                                                        echo "<td>" . $key['Nome'] . "</td>";
                                                        echo "<td>" . $key['Apelido'] . "</td>";
                                                        echo "<td>" . $key['Sexo'] . "</td>";
                                                        echo "<td>" . $key['Telefone']. "</td>";
                                                        echo "<td>" . $key['Endereco']. "</td>";
                                                        echo "<td>" . $key['Email']. "</td>";
                                                        echo "<td>" . $key['Senha']. "</td>";
                                                        echo "<td>" . $key['Funcao']. "</td>";
                                                        echo "<td>".busca_departamento($key['Id_departamento'])."</td>";
                                                        echo '<td>';
                                                        echo "</tr>";
                                                    endwhile;
                                                else:
                                                    echo '<tr>';
                                                    echo '<td>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<h1 style="font-color:#eee ;font-size:20px; position:absolute; left:310px;">Nenhum Processo Cadastrado no Sistema!</h1>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                endif;
                                                ?>



   

                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /# row -->

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
