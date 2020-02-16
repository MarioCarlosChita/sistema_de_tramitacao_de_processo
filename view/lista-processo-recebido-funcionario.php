
<?php
include '../controller/conexao/conexao.php';
session_start();
if (empty($_SESSION['funcionario'])):
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
                        <li class="label">Processos</li>
                        <li>
                            <a class="sidebar-sub-toggle">
                                <i class="ti-bookmark"></i>Processos Gerais<span class="sidebar-collapse-icon ti-angle-down"></span>
                             </a>
                             <ul>
                                <li><a href="add-processo.php">Adicionar de Processos</a></li>          
                             </ul>
                             <ul>
                                <li><a href="lista-processo-funcionario.php?id=<?php echo $_SESSION['id']?>">Meus Processos</a></li>         
                             </ul>
                             <ul>
                                <li><a href="lista-processo-recebido-funcionario.php?id=<?php echo $_SESSION['id']?>">Processos Recebidos</a></li>         
                             </ul>
                             <ul>
                                <li><a href="lista-processo-enviado-funcionario.php?id=<?php echo $_SESSION['id']?>">Processos Enviados</a></li>         
                             </ul>
                        </li>
                        <li>
                         <a class="sidebar-sub-toggle">
                                <i class="ti-bookmark"></i>Configurações Pessoais<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="update-funcionario-perfil.php?id=<?php echo $_SESSION['id']?>">Meu Perfil</a></li>
                            </ul>
                        </li>
                        <li><a  href="logout.php?funcao=sair-funcionario"><i class="ti-close"></i> Sair</a></li>
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
 
                                     $query = $conexao->getconexao()->prepare("select * from funcionario where ID_funcionario=:id");
                                
                                     $query->execute(array(
                                          ':id'=>$_SESSION['id']
                                     ));
                                     while ($row = $query->fetch(PDO::FETCH_ASSOC)):
                                         $nome = $row['Nome'];
                                         $id = $row['ID_funcionario'];
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
                                            <span class="text-left">Funcionario Activo
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
                                    <h1>Lista de Processo Recebidos<span> >>> <a href="funcionario-page.php">Pagina Inicial</a></span></h1>
                                </div>
                                <div class="page-title text-center container-fluid " style="padding-left:300px;">
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
                                                    <th>Cod-processo </th>
                                                    <th>Nome</th>
                                                    <th>Data</th>
                                                    <th>Ficheiro</th>
                                                    <th>Enviado Por</th>   
                                                    <th>Departamento origin</th>                     
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                               function nomedepartamento($id){
                                                $conexao=  new conexao();
                                                $queries  =$conexao->getconexao()->prepare('select * from funcionario  where ID_funcionario=:id');
                                                $queries->execute(Array(
                                                     ':id'=>$id
                                                ));
                                                
                                                for(;$linha = $queries->fetch(PDO::FETCH_ASSOC);):
                                                      $id_meu_departamento  = $linha['Id_departamento'];
                                                endfor;
                                                // buscando nome do departamento
                                                $consulta =  $conexao->getconexao()->prepare('select * from  departamento where  Id_Departamento=:id');
                                                $consulta->execute(Array(
                                                      ':id'=>$id_meu_departamento
                                                ));
                                                // fim do departamento;
                                            
                                              for(;$row =  $consulta->fetch(PDO::FETCH_ASSOC);):
                                                      return $row['Nome'];
                                              endfor; 

                                              }

                                                function nomeemissor($id){
                                                     $conexao=  new conexao();
                                                      $queries  =$conexao->getconexao()->prepare('select * from funcionario  where ID_funcionario=:id');
                                                      $queries->execute(Array(
                                                           ':id'=>$id
                                                      ));
                                                      while($linha =  $queries->fetch(PDO::FETCH_ASSOC)):
                                                            $nome =$linha['Nome'];
                                                      endwhile;
                                                        return $nome;
                                                }
                                                
                                                $queries = $conexao->getconexao()->prepare('select * from enviados where id_receptor=:id order by Nome ');
                                                $queries->execute(array(
                                                     ':id'=>$_SESSION['id']
                                                ));
                                                if ($queries->rowCount() != 0):
                                                    while ($key = $queries->fetch()):
                                                        echo "<tr>";
                                                        echo '<th scope="row">' . $key['Codigo'] . '</th>';
                                                        echo "<td>" . $key['Nome'] . "</td>";
                                                        echo "<td>" . $key['Data'] . "</td>";
                                                        echo '<td><a href="../upload-files/' .$key['Ficheiro']. '">Ficheiro</a></td>';
                                                        echo "<td>".nomeemissor($key['id_emissor']) ."</td>";
                                                        echo "<td>".nomedepartamento($key['id_emissor']) ."</td>";
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
