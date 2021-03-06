
<?php
include '../controller/conexao/conexao.php';
session_start();
if (empty($_SESSION['departamento'])):
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
                        
                        <li>
                            <a class="sidebar-sub-toggle"><i class="ti-book"></i>Gerir Funcionario <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul> 
                               <li><a href="add-funcionario-departamento.php">Adicionar Funcionário</a></li>
                               <li><a href="lista-funcionario-departamento.php"> Lista de Funcionário</a></li>
                            </ul>
                        </li>

                        <li class="label">Processos</li>
                        <li><a class="sidebar-sub-toggle">
                                <i class="ti-bookmark"></i>Processos Gerais<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>          
                                <li><a href="lista-processo-departamento.php">Lista de Processos</a></li>
                            </ul>
                            <ul>          
                                <li><a href="lista-processo-enviado-departamento .php">Monitoramento de Processos</a></li>
                            </ul>
                        </li>
                        <li>
                        <a class="sidebar-sub-toggle">
                                <i class="ti-bookmark"></i>Minhas Confugurações<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="perfil-departamento.php">Meu Perfil</a></li>
                            </ul>
                        </li>
                        <li><a  href="logout.php?funcao=sair-departamento"><i class="ti-close"></i>Sair</a></li>
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
                                 
                            </div>
                            
                            <?php
                                     $conexao = new conexao();
                                     $nome = "";
                                     $email = "";
                                     $id_departamento = $_SESSION['id'];
                                     $query = $conexao->getconexao()->prepare("select * from departamento where Id_Departamento=:id");
                                     $query->execute(array(
                                           ':id'=>$id_departamento
                                     ));
                                     while ($row = $query->fetch(PDO::FETCH_ASSOC)):
                                         $nome = $row['Nome'];
                                         $email = $row['Email'];
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
                                            <span class="text-left">Departamento Activo
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
                                    <h1>Lista de Processo Enviados<span> >>> <a href="login-departamento.php">Pagina Inicial</a></span></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>Processos</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Cod-processo </th>
                                                    <th>Nome</th>
                                                    <th>Data</th>
                                                    <th>Ficheiro</th>
                                                    <th>Enviado por</th>
                                                    <th>Para</th>
                                                    <th>Departamento Origin </th>
                                                    
                                        
                                                </tr>
                                            </thead>
                                            <tbody>


                                            <?php
                                                function nome_funcionario($id){
                                                     $conexao = new conexao();
                                                     $add = $conexao->getconexao()->prepare('select * from funcionario where ID_funcionario=:id');
                                                     $add->execute(array( 
                                                          ':id'=>$id
                                                     ));
                                                     while($linha =$add->fetch()){
                                                          $nome =$linha['Nome'];
                                                     }
                                                     return $nome;
                                                }
 
                                                $index = 0;
                                                $queries = $conexao->getconexao()->prepare('select * from enviados where id_departamento=:id');
                                                $queries->execute(array(
                                                     ':id'=>$id_departamento
                                                ));
                                                if ($queries->rowCount() != 0):
                                                    while ($key = $queries->fetch()):
                                                        
                                                        echo '<th scope="row">' . ++$index . '</th>';
                                                        echo "<td>" . $key['Codigo'] . "</td>";
                                                        echo "<td>" . $key['Nome'] . "</td>";
                                                        echo "<td>" . $key['Data'] . "</td>";
                                                        echo '<td><a href="../upload-files/' .$key['Ficheiro']. '">Ficheiro</a></td>';
                                                        echo "<td>" . nome_funcionario($key['id_emissor'])."</td>";
                                                        echo "<td>" . nome_funcionario($key['id_receptor'])."</td>";
                                                        echo "<td>".$key['Nome_departamento']."</td>";
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
