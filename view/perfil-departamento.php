
<?php
 
 include '../controller/conexao/conexao.php';
 session_start();


 function quantidade($id_funcionario){
    $conexao = new conexao();
    $queries =  $conexao->getconexao()->prepare('select * from processo where Idfuncionario=:id');
    $queries->execute(array(
         ':id'=>$id_funcionario  
    ));
    return $queries->rowCount(); 
 }

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
         <title>Gestor de Tramitação de Processos</title>
         <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
 
         <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
          
         <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
     
         <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
       
         <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
        
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
                        
                        <li>
                            <a class="sidebar-sub-toggle"><i class="ti-book"></i>Gerir Funcionario <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul> 
                               <li><a href="add-funcionario-departamento.php"> Adicionar Funcionário</a></li>
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
                        <li><a  href="logout.php?funcao=sair-departamento"><i class="ti-close"></i> Sair</a></li>
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
                                    <h1>Configurações do Admin<span> >>> <a href="login-departamento.php">Pagina Inicial</a></span></h1>
                                </div>
                            </div>
                        </div>

                    </div>
                        <?php
                                  if (isset($_GET['message'])):
                                        if (!empty($_GET['message'])):
                                            if ($_GET['message'] == '1'):
                                                echo '<span style="font-size:18px; color:green;text-align:center! important;"> Departamento Atualizado Com Sucesso!</span>';
                                            endif;
                                            if ($_GET['message'] == '-1'):
                                                echo '<span style="font-size:18px; color:orange; text-align:center;"> Este Email ja Existe!</span>';
                                            endif;
                                        endif;

                                    endif;

                          ?> 
                    <!-- /# row -->
                    <section id="main-content">
                        <form  method="POST"  action="../modal/admin-setting.php?funcao=Alterar-departamento&&id-departamento=<?php echo $id_departamento ?>">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="basic-form">
                                          <div class="form-group">
                                                <p class="text-muted m-b-15 f-s-12">Email</p>
                                                <input type="email" class="form-control input-flat" value="<?php echo $email ?>" name="email" required="">
         
                                            </div>

                                            <div class="form-group">
                                                <p class="text-muted m-b-15 f-s-12">Senha</p>
                                                <input type="password" class="form-control input-flat" placeholder="Nova Senha" name="senha" required="">
                                            </div>      
                                            <div class="col-lg-12">
                                                 <input type="submit" class="btn btn-primary btn-block m-b-10"   value="Actualizar" />               
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
