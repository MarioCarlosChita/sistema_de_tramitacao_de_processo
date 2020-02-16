<?php

include 'conexao/conexao.php';

$usuario = $_POST['nome'];
$senha = $_POST['senha'];

login($usuario, $senha);

function login($usuario, $senha) {

    if (empty($usuario) || empty($senha)):
        header('location:../view/error-login.php');
    else:
        $con = new conexao();
        $senha = sha1($senha);
        $query = $con->getconexao()->prepare("Select * from admin where nome=:Usuario and senha=:senha");
        $query->execute(array(
            ":Usuario" => $usuario,
            ":senha" => $senha,
        ));
        if ($query->rowCount() > 0):
            session_start();
            $usuario = "";
            while ($row = $query->fetch(PDO::FETCH_ASSOC)):
                    $usuario = $row['nome'];
            endwhile;
            $_SESSION['admin']  = $usuario;
            header('location:../view/admin-page.php');
                
        else:
             // login com o funcionario
            
            $con = new conexao();
            $add = $con->getconexao()->prepare('select * from funcionario  where Email=:email and Senha=:senha');
            $add->execute(array(
                 ':email'=>$usuario, 
                 ':senha'=>$senha
            ));

     if($add->rowCount() >  0):
         session_start();
         for(;$linha = $add->fetch();):  
                  $user =$linha['Nome'];
                  $id = $linha['ID_funcionario'];
          endfor;  
            $_SESSION['funcionario'] =$user;
            $_SESSION['id']=  $id;
            header('location:../view/funcionario-page.php');
        else:
            
            $con = new conexao();
            $add = $con->getconexao()->prepare('select * from departamento  where Email=:email and Senha=:senha');
            $add->execute(array(
                 ':email'=>$usuario, 
                 ':senha'=>$senha
            ));
            if($add->rowCount() > 0):    
                // verificando se existe um usuario;
                session_start();

                for(;$linha = $add->fetch();):  
                  $user =$linha['Nome'];
                  $id = $linha['Id_Departamento'];
                endfor;
                // login para o departamento ;

            $_SESSION['departamento'] =$user;
            $_SESSION['id']=  $id;
            header('location:../view/login-departamento.php');

          else:
               header('location:../view/error-login.php');
          endif;
    endif;
             
        endif;
    endif;
}

?>
