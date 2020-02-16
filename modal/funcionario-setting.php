<?php

  include_once 'CrudFuncionario.php';

  $capitura_departamento  = "";


if(isset($_GET['id'])):
   $id = $_GET['id'];
endif;

  if($_GET['funcao'] == "cadastrar"):
     $nome =$_POST['nome'];
     $file =$_FILES['file'];
     $descricao =$_POST['descricao'];

     $filename =$_FILES['file']['name'];
     $fileTmpNama =$_FILES['file']['tmp_name'];
     $filesize =  $_FILES['file']['size'];
     $fileerror = $_FILES['file']['error'];
     $filetype =$_FILES['file']['type'];



     $fileExt = explode('.' ,$filename);
     $fileActualExt =  strtolower(end($fileExt));

     $allowed = array('pdf', 'docx' , 'txt','png','jpg','jpeg','zip','doc','pptx','pptx','xlsx');

     if(in_array($fileActualExt , $allowed)){

          if($fileerror == 0 ){

              if($filesize  < 101400000000000){

                  $fileNewName = uniqid('' , true).".".$fileActualExt;
                  $fileDestination = "../upload-files/".$fileNewName;
                  move_uploaded_file($fileTmpNama ,$fileDestination);
                  $conexao  = new conexao();
                  $busca =$conexao->getconexao()->prepare("select * from processo");
                  $busca->execute();
                  for(;$row =$busca->fetch();):
                       $valor =$row['codigo'];
                  endfor;


                  $codigo = $valor+1;
                  $add=  $conexao->getconexao()->prepare('insert into processo(Nome,Data,Ficheiro,descricao, codigo,Idfuncionario)values(:nome,Now(),:ficheiro,:descricao,:codigo,:id)');
                  $add->execute(array(
                     ':nome'=>$nome,
                     ':codigo'=>$codigo,
                     ':ficheiro'=>$fileNewName ,
                     ':descricao'=>$descricao ,
                     ':id'=>$id
                  ));
                  header('location:../view/add-processo.php?message=1');
              }else{
                header('location:../view/add-processo.php?message =-2');
              }

          }else{
            header('location:../view/add-processo.php?message=-1');
          }

     }else{
          header('location:../view/add-processo.php?message=-3');
     }



  endif;

if($_GET['funcao'] == "deletar_processo"):

  $id = $_GET['id'];
  $conexao = new conexao();
  $add = $conexao->getconexao()->prepare('delete from processo where id_processo=:id');
  $add->execute(array(
     ':id'=>$id
  ));
  header('location:../view/lista-processo-funcionario.php');


endif;



if($_GET['funcao'] == "update"):
      $id_processo = $_GET['id_processo'];
      $id =$_GET['id'];
      $nome =$_POST['nome'];
      $file =$_FILES['file'];
      $descricao =$_POST['descricao'];

     $filename =$_FILES['file']['name'];
     $fileTmpNama =$_FILES['file']['tmp_name'];
     $filesize =  $_FILES['file']['size'];
     $fileerror = $_FILES['file']['error'];
     $filetype =$_FILES['file']['type'];


     $fileExt = explode('.' ,$filename);
     $fileActualExt =  strtolower(end($fileExt));

     $allowed = array('pdf', 'docx' , 'txt','png','jpg','jpeg','zip','doc');

     if(in_array($fileActualExt , $allowed)){

          if($fileerror == 0 ){

              if($filesize  < 101400000000){

                  $fileNewName = uniqid('' , true).".".$fileActualExt;
                  $fileDestination = "../upload-files/".$fileNewName;
                  move_uploaded_file($fileTmpNama ,$fileDestination);


                  $conexao  = new conexao();


                  $codigo =base64_encode($nome);
                  $add=  $conexao->getconexao()->prepare('update processo Set Nome=:nome,Data=Now(),Ficheiro=:ficheiro,descricao=:descricao,codigo=:codigo,Idfuncionario=:id where id_processo=:id_processo');
                  $add->execute(array(
                     ':nome'=>$nome,
                     ':codigo'=>$codigo,
                     ':ficheiro'=>$fileNewName ,
                     ':descricao'=>$descricao ,
                     ':id'=>$id ,
                     ':id_processo'=>$id_processo
                  ));
                  header('location:../view/update-processo.php?message=1&&id_processo='.$id_processo);
              }else{
                header('location:../view/update-processo.php?message =-2&&id_processo='.$id_processo);
              }

          }else{
            header('location:../view/update-processo.php?message=-1&&id_processo='.$id_processo);
          }

     }else{
          header('location:../view/update-processo.php?message=-3&&id_processo='.$id_processo);
     }


endif;


if($_GET['funcao'] =="enviar"):


    // campos que serao cadastrados
    $email_receptor =$_POST['email'];
    $id_receptor = buscaemail ($email_receptor);
    $id_processo =$_GET['id_processo'];
    $id_emissor  =$_GET['id_funcionario'];
    $id_departamento  = buscadepartamento($email_receptor);
    $nome_departamento =   buscaNomedepartamento($id_departamento);
   // fim dos campos de cadastros
    $conexao   = new conexao();

    for($i = 0  ;  $i<sizeof(processo($id_processo)); ++$i):
       $add  = $conexao->getconexao()->prepare('Insert into
         enviados(id_emissor, id_receptor,id_departamento,Nome_departamento,Nome,Data,Ficheiro,Descricao,Codigo)
         Values(:id_emissor, :id_receptor,:id_departamento,:Nome_departamento,:Nome,Now(),:Ficheiro,:Descricao,:Codigo)');

      $add->execute(Array(
           ':id_emissor'=>$id_emissor,
           ':id_receptor'=>$id_receptor,
           ':id_departamento'=>$id_departamento,
           ':Nome_departamento'=>$nome_departamento ,
           ':Nome'=>processo($id_processo)[$i]['Nome'],
           ':Ficheiro'=>processo($id_processo)[$i]['Ficheiro'],
           ':Descricao'=>processo($id_processo)[$i]['descricao'],
           ':Codigo'=>processo($id_processo)[$i]['codigo']
      ));

    endfor;

    echo  '<div style="padding-top:120px;">';
    echo  '<h1 style="color:green; text-align:center">Processo Enviado com Sucesso para:'.$email_receptor.'</h1>';
    echo  '<a href="../view/lista-processo-funcionario.php?id='.$id_emissor.'" style="padding-left:45%;">Retrocer na Pagina</a></span>';
    echo  '</div>';


endif;



function buscaemail ($email){
     $conexao  = new conexao();
     $queries = $conexao->getconexao()->prepare('select * from funcionario where email=:email');
     $queries->execute(Array(
          ':email'=>$email
     ));
     for(;$row = $queries->fetch(PDO::FETCH_ASSOC);):
             return $row ['ID_funcionario'];

     endfor;
}

function buscadepartamento ($email){
     $conexao  = new conexao();
     $queries = $conexao->getconexao()->prepare('select * from funcionario where email=:email');
     $queries->execute(Array(
          ':email'=>$email
     ));
     for(;$row = $queries->fetch(PDO::FETCH_ASSOC);):
             return $row ['Id_departamento'];
     endfor;
}



function processo($id_processo){
  $conexao  = new conexao();
  $queries = $conexao->getconexao()->prepare('select * from processo where id_processo=:id_processo');
  $queries->execute(Array(
       ':id_processo'=>$id_processo
  ));
  for(;$row = $queries->fetch(PDO::FETCH_ASSOC);):
          $lista[] =$row;
  endfor;
  return $lista;
}

function buscaNomedepartamento($id_departamento){
  $conexao  = new conexao();
  $queries = $conexao->getconexao()->prepare('select * from departamento where Id_departamento=:id_departamento');
  $queries->execute(Array(
       ':id_departamento'=>$id_departamento
  ));
  for(;$row = $queries->fetch(PDO::FETCH_ASSOC);):
          return $row ['Nome'];
  endfor;


}



?>
