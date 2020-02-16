
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
         <title>Gestor de Tramitação de Processos</title>
         <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
 
         <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
         <!-- Retina iPhone Touch Icon-->
         <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
         <!-- Standard iPad Touch Icon-->
         <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
         <!-- Standard iPhone Touch Icon-->
         <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
         <!-- Styles -->
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
         <link href="assets/css/style.css" rel="stylesheet">
     </head>
 
     <body>

     <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures " style="color:black ! important;">
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

                        <li><a  href="logout.php?funcao=sair"><i class="ti-close"></i> Sair</a></li>
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
                                     <span class="user-avatar">
                                         <?php
                                            echo $_SESSION['admin'];
                                         ?>
 
                                         <i class="ti-angle-down f-s-10">
 
                                         </i>
                                     </span>
 
                                     <?php
                                     $conexao = new conexao();
                                     $nome = "";
                                     $email = "";
 
                                     $query = $conexao->getconexao()->prepare("select * from admin");
                                     $query->execute();
 
                                     while ($row = $query->fetch(PDO::FETCH_ASSOC)):
                                         $nome = $row['nome'];
                                         $email = $row['email'];
                                     endwhile;
                                     ?>
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
                                                         <span style="font-size:10px;"> <?php echo $email; ?></span>
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
                                     <h1>Olá, <span>Seja BemVindo ao Sistema</span></h1>
                                 </div>
                             </div>
                         </div>
                         <!-- /# column -->
 
                         <!-- /# column -->
                     </div>
                     <!-- /# row -->
                     <section id="main-content">
                         <div class="row">
                             <div class="col-lg-3">
                                 <div class="card">
                                     <div class="stat-widget-one">
                                         <div class="stat-icon dib"><i class="ti-home color-success border-success"></i></div>
                                         <div class="stat-content dib">
                                             <div class="stat-text">Departamento</div>
                                             <div class="stat-digit">
                                               <?php
                                                   $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare('select * from departamento');
                                                   $queries->execute();
                                                   echo $queries->rowCount();
 
                                                ?>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-lg-3">
                                 <div class="card">
                                     <div class="stat-widget-one">
                                         <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i></div>
                                         <div class="stat-content dib">
                                             <div class="stat-text">Funcionario</div>
                                             <div class="stat-digit">
                                             <?php
                                                   $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare('select * from funcionario');
                                                   $queries->execute();
                                                   echo $queries->rowCount();
 
                                                ?>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-lg-3">
                                 <div class="card">
                                     <div class="stat-widget-one">
                                         <div class="stat-icon dib"><i class="ti-book color-pink border-pink"></i></div>
                                         <div class="stat-content dib">
                                             <div class="stat-text">Processo</div>
                                             <?php
                                                   $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare('select * from processo');
                                                   $queries->execute();
                                                   echo $queries->rowCount();
 
                                                ?>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             
                         </div>
 
                         <div class="row">
                             <div class="col-lg-4">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         
                                     </div>
                                     <div class="col-lg-12">
                                         <div class="card">
                                             <div class="testimonial-widget-one p-17">
                                                 <div class="testimonial-widget-one owl-carousel owl-theme">  
                                                <?php
                                                  
                                                  $queries = $conexao->getconexao()->prepare('select * from departamento');
                                                  $queries->execute();
                                                  if ($queries->rowCount() != 0):
                                                      while ($key = $queries->fetch()):
                                                        echo  '<div class="item">
                                                        <div class="testimonial-content">
                                                            <div class="testimonial-author">';
                                                        echo  '<span> Departamento </span>';
                                                        echo '<span style="font-size:23px;">'.$key['Nome'].'</span>'.'</div>';
                                                        echo  '<div class="testimonial-author-position">Responsavel: '. $key['Usuario'];
                                                        echo  '</div>';
                                                        echo  ' </div>
                                                               </div>';    
                                                
                                                      endwhile; 
                                                    else:
                                                        echo  '<h1>Nenhum Departamento !</h1>';
                                                    endif;   


                                                 ?>
                                                                    
                                                 </div>
                                             </div>
                                         </div>
 
                                     </div>
                                 </div>
                             </div>
                             <!-- /# column -->
                             <div class="col-lg-8">
                           
                                 <div class="card" style="margin-top:31px;">
                                     <div class="card-title pr">
                                         <h4>Departamento Cadastrado Recetemente...</h4>
                                     </div>
                                     <div class="card-body">
                                         <div class="table-responsive">
                                             <table class="table student-data-table m-t-20">
                                                 <thead>
                                                     <tr>
                                                         <th>Numero</th>
                                                         <th>Nome</th>
                                                         <th>Responsavel</th>
                                                       
                                                       
    
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                 <?php
                                                 $index = 0;
                                                $queries = $conexao->getconexao()->prepare('select * from departamento');
                                                $queries->execute();
                                                if ($queries->rowCount() != 0):
                                                    while ($key = $queries->fetch()):
                                                        $id = $key['Id_Departamento'];
                                                        $nome = $key['Nome'];
                                                        echo '<th scope="row">' . ++$index . '</th>';
                                                        echo "<td>" . $key['Nome'] . "</td>";
                                                        echo "<td>" . $key['Usuario'] . "</td>";
    
                                                        echo '<td>';
                                                        echo "</tr>";
                                                    endwhile;
                                                else:
                                                    echo '<tr>';
                                                    echo '<td>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<h1 style="font-color:#eee ;font-size:20px; position:absolute; left:310px;">Nenhum Departamento Cadastrado no Sistema!</h1>';
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
                                                </tbody>                                                       </tbody>
                                             </table>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <!-- /# column -->
                         </div>
                         <!-- /# row -->
 
 
                         <!-- /# row -->
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
 