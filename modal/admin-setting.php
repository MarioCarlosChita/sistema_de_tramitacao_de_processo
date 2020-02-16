<?php

include 'CrudAdmin.php';




// atualizando os dados o admin
if($_GET['funcao'] =="Alterar"){
      
    $nome  =$_POST['nome'];
    $email =  $_POST['email'];
    $senha =   $_POST['senha'];
    $update = new Admin();
    $update->updateadmin($nome, $email, $senha);
    header('location:../view/perfil-admin.php');
}

// fim da actualizacao dos dados ;


if ($_GET['funcao'] == "Alterar-departamento"):
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $id =$_GET['id-departamento'];
    $update = new Admin();
    if($update->update_email_departamento($email,$id) > 0):
        header('location:../view/perfil-departamento.php?message=-1');
    else:
        $update->update_departamento($email , $senha,$id);
        header('location:../view/perfil-departamento.php?message=1');
        
    endif;   
endif;
if ($_GET['funcao'] == "cadastrar"):

    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha =$_POST['senha'];


    $add = new Admin();
    if ($add->Existe_departamento($nome) > 0):
        header('location:../view/add-departamento.php?message=-1');
    else:
        if ($add->Existe_usuario($usuario) > 0):
            header('location:../view/add-departamento.php?message=-2');
        else:
            if($add->Existe_email_deparatamento($email) <= 0):
                $add->add_departamento($nome, $usuario, $email,$senha);
                header('location:../view/add-departamento.php?message=1');       
            else:
                header('location:../view/add-departamento.php?message=-3');
            endif;
        endif;
    endif;
endif;

if ($_GET['funcao'] == "deletar"):
    //valores do departamento
    $id = $_GET['id'];
    $add = new Admin();
    $add->deletar_departamento($id);
    header('location:../view/lista-departamento.php');
endif;




if ($_GET['funcao'] == "update"):

    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email =$_POST['email'];
    $add = new Admin();

    if ($add->Existe_departamento1($nome, $_GET['id']) > 0):
        header('location:../view/update-departamento.php?message=-1&&nome=' . $nome . '&&id=' . $_GET['id']);
    else:
        if ($add->Existe_usuario1($usuario, $_GET['id']) > 0):
              header('location:../view/update-departamento.php?message=-2&&nome=' . $nome . '&&id=' . $_GET['id']);
        else:
            
    
            $id = $_GET['id'];
            $conexao = new conexao();
            $senha= sha1($senha);

            $queries = $conexao->getconexao()->prepare('update departamento set Nome=:nome , Senha=:senha , Usuario=:usuario, Email=:email WHERE Id_Departamento=:id');
            $queries->execute(array(
                ':nome' => $nome,
                ':usuario' => $usuario,
                ':senha' => $senha,
                ':email' => $email,
                ':id' => $id
            ));
            header('location:../view/update-departamento.php?message=1&&nome=' . $nome . '&&id=' . $id);
  
        endif;
    endif;

endif;



if($_GET['funcao'] == "cadastrar-funcionario"):
     
     $nome = $_POST['nome'];
     $apelido = $_POST['apelido'];
     $sexo =$_POST['sexo'];
     $telefone =$_POST['telefone'];
     $endereco =$_POST['endereco'];
     $email =$_POST['email'];
     $senha = $_POST['senha'];
     $funcao =$_POST['funcao'];
     $departamento = $_POST['departamento'];
     $admin  = new Admin();
     $id_value =$admin->busca_id($departamento);

    if($admin->email_existe_funcionario1($email) > 0):
            header('location:../view/add-funcionario-departamento.php?message=-1');
    else:
        if($admin->telefone_existe_funcionario1($telefone) > 0):
            header('location:../view/add-funcionario-departamento.php?message=-2');      
        else:
            $admin->add_funcionario($nome,$apelido,$sexo,$telefone,$endereco,$email,$senha,$funcao,$id_value);
            header('location:../view/add-funcionario-departamento.php?message=1'); 
 
        endif;  

    endif;   

endif;   



if($_GET['funcao'] == "deletar_funcionario"):
      $admin = new Admin();
      $id = $_GET['id'];
      $admin->deletar_funcionario($id);
      header('location:../view/lista-funcionario-departamento.php'); 
endif;    


if($_GET['funcao'] =="alterar-funcionario"):
      $nome = $_POST['nome'];
      $apelido = $_POST['apelido'];
      $sexo =$_POST['sexo'];
      $telefone =$_POST['telefone'];
      $endereco =$_POST['endereco'];
      $email =$_POST['email'];
      $senha = $_POST['senha'];
      $funcao =$_POST['funcao'];
      $departamento = $_POST['departamento'];
      $admin = new Admin();
      $id =$_GET['id'];
      $id_value =$admin->busca_id($departamento);
      if($admin->email_existe_funcionario($email ,$id) > 0):
        header('location:../view/update-funcionario-departamento.php?message=-1&&id='.$id);
 else:
    
     if($admin->telefone_existe_funcionario($telefone ,$id) > 0):
         header('location:../view/update-funcionario-departamento.php?message=-2&&id='.$id);      
     else:
         $admin->update_funcionario($nome,$apelido,$sexo,$telefone,$endereco,$email,$senha,$funcao,$id_value , $id);
         header('location:../view/update-funcionario-departamento.php?message=1&&id='.$id); 

     endif;  

 endif; 

endif;    


if($_GET['funcao'] == "perfil-funcionario"):
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $sexo =$_POST['sexo'];
    $telefone =$_POST['telefone'];
    $endereco =$_POST['endereco'];
    $email =$_POST['email'];
    $senha = $_POST['senha'];
    $funcao =$_POST['funcao'];
    $departamento = $_POST['departamento'];
    $admin = new Admin();
    $id =$_GET['id'];
    $id_value =$admin->busca_id($departamento);
    if($admin->email_existe_funcionario($email,$id) > 0):
      header('location:../view/update-funcionario-perfil.php?message=-1&&id='.$id);
else:
   if($admin->telefone_existe_funcionario($telefone ,$id) > 0):
       header('location:../view/update-funcionario-perfil.php?message=-2&&id='.$id);      
   else:
       $admin->update_funcionario($nome,$apelido,$sexo,$telefone,$endereco,$email,$senha,$funcao,$id_value , $id);
       header('location:../view/update-funcionario-perfil.php?message=1&&id='.$id); 

   endif;  

endif; 

endif;    

?>