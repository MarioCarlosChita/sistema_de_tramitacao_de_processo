
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
                                    <h1 style="padding-left:16px;">Lista de Processo<span> >>> <a href="funcionario-page.php">Pagina Inicial</a></span></h1>
                                </div>
                                <div class="col-lg-12">
                                    <form name="pesquisa" method = "post" action="lista-processo-funcionario.php?id=<?php echo $_SESSION['id']; ?>">
                                       <input type="text" name="pesquisa" style="width:300px; height:40px; padding-left:5px;" placeholder="pesquisa pelo:titulo">
                                       <input type="submit" value="pesquisar" style="background-color:#ca6f80; border:none; height:40px;">
                                    </form>
                                </div>

                                <div class="page-title text-center container-fluid " style="padding-left:300px;">
                                </div>
                            </div>
                        </div>

                      <?php if(empty($_POST['pesquisa'])):?>
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
                                                    <th>Configurações</th>
                                                    <th>Enviar Ficheiro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $index = 0;
                                                $queries = $conexao->getconexao()->prepare('select * from processo where idfuncionario=:id order by Nome ');
                                                $queries->execute(array(
                                                     ':id'=>$_SESSION['id']
                                                ));
                                                if ($queries->rowCount() != 0):
                                                    while ($key = $queries->fetch()):
                                                        $id = $key['id_processo'];
                                                        echo '<th scope="row">' .$key['codigo']. '</th>';
                                                        echo "<td>" . $key['Nome'] . "</td>";
                                                        echo "<td>" . $key['Data'] . "</td>";
                                                        echo '<td><a href="../upload-files/' .$key['Ficheiro']. '">Ficheiro</a></td>';
                                                        echo  '<td>';
                                                        echo "<a href='update-processo.php?funcao=update_funcionario&&id_processo=${id}' class='btn btn-success btn-rounded m-b-10 m-l-5'>Alterar</a>";
                                                        echo "<a href='../modal/funcionario-setting.php?funcao=deletar_processo&&id=${id}' class='btn btn-danger btn-rounded m-b-10 m-l-5'>Deletar</a>";
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo '<form method="POST" action="../modal/funcionario-setting.php?funcao=enviar&&id_processo=';
                                                        echo $key['id_processo'];
                                                        echo  '&&id_funcionario='.$_SESSION['id'].'">';
                                                        echo '<select name="email">';
                                                            $busca = $conexao->getconexao()->prepare('select * from funcionario where ID_funcionario !=:id');
                                                            $busca->execute(array(
                                                                 ':id'=>$_SESSION['id']
                                                            ));
                                                            for(;$row=$busca->fetch();):
                                                                  echo '<option>';
                                                                  echo $row['Email'];
                                                                  echo '</option>';
                                                            endfor;
                                                        echo '</select>';
                                                        echo  '<br>';
                                                        echo  '<input type="submit" value="Tramitar" style="width:80px; height:40px; background-color:#ca6f80;color:white; font-family:tahoma;">';
                                                        echo '</form>';

                                                        echo '</td>';
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
                      <?php else:?>
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
                                                    <th>Configurações</th>
                                                    <th>Enviar Ficheiro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $index = 0;
                                                   $queries = $conexao->getconexao()->prepare('select * from processo where  Nome LIKE :pesquisa and  Idfuncionario=:id or codigo LIKE :pesquisa');
                                                   $pesquisa =  trim($_POST['pesquisa']);
                                                   $p = '%'.$pesquisa.'%';
                                                   $queries->bindValue(":pesquisa",$p , PDO::PARAM_STR);
                                                   $queries->bindValue(":id", $_SESSION['id']);
                                                   $queries->execute();
                                                   if ($queries->rowCount() != 0):
                                                         // buscando a pesquisa do usuario;
                                                  while($key =  $queries->fetch()):
                                                    $id = $key['id_processo'];
                                                    echo '<th scope="row">' .$key['codigo']. '</th>';
                                                    echo "<td>" . $key['Nome'] . "</td>";
                                                    echo "<td>" . $key['Data'] . "</td>";
                                                    echo '<td><a href="../upload-files/' .$key['Ficheiro']. '">Ficheiro</a></td>';
                                                    echo  '<td>';
                                                    echo "<a href='update-processo.php?funcao=update_funcionario&&id_processo=${id}' class='btn btn-success btn-rounded m-b-10 m-l-5'>Alterar</a>";
                                                    echo "<a href='../modal/funcionario-setting.php?funcao=deletar_processo&&id=${id}' class='btn btn-danger btn-rounded m-b-10 m-l-5'>Deletar</a>";
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<form method="POST" action="../modal/funcionario-setting.php?funcao=enviar&&id_processo=';
                                                    echo $key['id_processo'];
                                                    echo  '&&id_funcionario='.$_SESSION['id'].'">';
                                                    echo '<select name="email">';
                                                        $busca = $conexao->getconexao()->prepare('select * from funcionario where ID_funcionario !=:id');
                                                        $busca->execute(array(
                                                             ':id'=>$_SESSION['id']
                                                        ));
                                                        for(;$row=$busca->fetch();):
                                                              echo '<option>';
                                                              echo $row['Email'];
                                                              echo '</option>';
                                                        endfor;
                                                    echo '</select>';
                                                    echo  '<br>';
                                                    echo  '<input type="submit" value="Tramitar" style="width:80px; height:40px; background-color:#ca6f80;color:white; font-family:tahoma;">';
                                                    echo '</form>';
                                                    echo '</td>';
                                                    echo "</tr>";
                                                         endwhile;
                                                         // fim da pesquisa
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
