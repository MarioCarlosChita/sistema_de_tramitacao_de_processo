
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
         <title>Gestor de Tramitação de Processos</title>
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
                                <i class="ti-bookmark"></i>Processos Gerais<span class="sidebar-collapse-icon ti-angle-down"></span></a>
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
                        <li><a  href="logout.php?funcao=sair-funcionario"><i class="ti-close"></i>Sair</a></li>
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
                                  
                                     <div class="drop-down dropdown-menu dropdown-menu-right">
                                         <div class="dropdown-content-heading">
                                             <span class="text-left">Recent Notifications</span>
                                         </div>
                                        
                                     </div>
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
                                             <div class="stat-text">Total Processos</div>
                                             <div class="stat-digit">
                                               <?php
                                                 
                                                   // quantidade de processos
                                                   $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare('select * from processo where Idfuncionario=:id');
                                                   $queries->execute(array(
                                                        ':id'=>$_SESSION['id']
                                                   ));
                                                   $numero1 = $queries->rowCount();

                                                    // fim dos processos;

                                                 //  numeros de processos
                                                   $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare("select * from enviados  where id_receptor=:id");
                                    
                                                   $queries->execute(array(
                                                        ':id'=>$_SESSION['id']
                                                   ));
                                                   $numero2= $queries->rowCount();
                                                //fim dos processos;
                                                 
                                                $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare("select * from enviados  where id_emissor=:id");
                                    
                                                   $queries->execute(array(
                                                        ':id'=>$_SESSION['id']
                                                   ));
                                                  $numero3= $queries->rowCount();
                                                  echo $numero1+$numero2+$numero3;
                                                ?>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>  
                             <div class="col-lg-3">
                                 <div class="card">
                                     <div class="stat-widget-one">
                                         <div class="stat-icon dib"></div>
                                         <div class="stat-content dib">
                                             <div class="stat-text">Processos Recebidos</div>
                                             <div class="stat-digit">
                                               <?php
                                                   $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare("select * from enviados  where id_receptor=:id");
                                    
                                                   $queries->execute(array(
                                                        ':id'=>$_SESSION['id']
                                                   ));
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
                                         <div class="stat-icon dib"></div>
                                         <div class="stat-content dib">
                                             <div class="stat-text">Processos Enviados</div>
                                             <div class="stat-digit">
                                               <?php
                                                   $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare("select * from enviados  where id_emissor=:id");
                                    
                                                   $queries->execute(array(
                                                        ':id'=>$_SESSION['id']
                                                   ));
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
                                         <div class="stat-icon dib"></div>
                                         <div class="stat-content dib">
                                             <div class="stat-text">Meus Processos</div>
                                             <div class="stat-digit">
                                               <?php
                                                   $conexao = new conexao();
                                                   $queries =  $conexao->getconexao()->prepare("select * from processo  where Idfuncionario=:id");
                                
                                                   $queries->execute(array(
                                                        ':id'=>$_SESSION['id']
                                                   ));
                                                   echo $queries->rowCount();
                                                ?>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div> 

                         </div>
                         <div class="row">
                             <div class="col-lg-4">
                                 <div class="row">
                                      
                                     <div class="col-lg-12">
                                         <div class="card">
                                             <div class="testimonial-widget-one p-17">
                                                 <div class="testimonial-widget-one owl-carousel owl-theme">  
                                                <?php
                                                  
                                                  $queries = $conexao->getconexao()->prepare('select * from processo where Idfuncionario=:id');
                                                  $queries->execute(array(
                                                       ':id'=>$_SESSION['id']
                                                  ));


                                                  if ($queries->rowCount() != 0):
                                                      while ($key = $queries->fetch()):
                                                        echo  '<div class="item">
                                                        <div class="testimonial-content">
                                                            <div class="testimonial-author">';
                                                        echo  '<span> Processo </span>';
                                                        echo "<br>";
                                                        echo '<span style="font-size:12px;">'.$key['Nome'].'</span>'.'</div>';
                                                        echo  '<div class="testimonial-author-position">Cod-processo: '.substr($key['codigo'],4);
                                                        echo  '</div>';
                                                        echo  ' </div>
                                                               </div>';    
                                                      endwhile; 
                                                    else:
                                                        echo  '<h4>Nenhum processo !</h4>';
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
                                 <div class="card" style="margin-top:14px;">
                                     <div class="card-title pr">
                                         <h4>Processo Cadastrado Recetemente...</h4>
                                     </div>
                                     <div class="card-body">
                                         <div class="table-responsive">
                                             <table class="table student-data-table m-t-20">
                                                 <thead>
                                                     <tr>
                                                         <th>Titulo</th>
                                                         <th>Cod-processo</th>
                                                         <th>Data</th>
                                                         <th>Ficheiro</th>

                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                 <?php
                                                 $index = 0;
                                                $queries = $conexao->getconexao()->prepare('select * from processo where Idfuncionario=:id');
                                                $queries->execute(array(
                                                     ':id'=>$_SESSION['id']
                                                ));
                                                if ($queries->rowCount() != 0):
                                                    while ($key = $queries->fetch()):
                                                    
                                                        echo "<td>" . $key['Nome'] . "</td>";
                                                        echo "<td>" . $key['codigo'] . "</td>"; 
                                                        echo "<td>" . $key['Data'] . "</td>";
                                                        echo '<td><a href="../upload-files/' .$key['Ficheiro']. '">Ficheiro</a></td>';
                                
                                                        echo "</tr>";
                                                    endwhile;
                                                else:
                                                    echo '<tr>';
                                                    echo '<td>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<h1 style="font-color:#eee ;font-size:15px; position:absolute; left:310px;">Nenhum Departamento Cadastrado no Sistema!</h1>';
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
 