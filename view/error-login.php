<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Focus Admin: Widget</title>


        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/lib/helper.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">

        <style type="text/css">
             .btn-primary{
                     background-color:#D45D3F! important;
               }
               .btn-primary:hover{
                     background-color: coral ! important;           
               }
              .login-logo span{
                     color:black;
                     font-size: 23;
                     font-weight: bold;
                }
                body{
                     background-image: url("../image/background.jpg") ! important;
                     background-size: cover ! important;
                }
    
              .myclass{
                    position:relative;
                    left:160px;
                    top:-10px;
                    color:coral;
            }

        </style>
    </head>

    <body class="bg-primary">

        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="login-content">
                            <div class="login-logo">
                                <a href="index.html"><span>Sistema de Gestão de Tramitação de processos </span></a>
                            </div>
                            <div class="login-form">
                                <h4>Administrador Login</h4>

                                   <form name="minhaApp" method="post" action="../controller/login.php">
                                       <div class="form-group">
                                            <span class="myclass">Erro de palavra passe tenta novamente !</span>
                                       </div>
                                    <div class="form-group">
                                        <label>Usuario </label>
                                        <input type="text" class="form-control" placeholder="Usuário"  name="nome">
                                    </div>
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input type="password" class="form-control" placeholder="Password" name="senha">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Entrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>
