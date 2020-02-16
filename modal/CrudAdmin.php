<?php

include '../controller/conexao/conexao.php';

class Admin {

    public function updateadmin($nome, $email, $senha) {
        $conexao = new conexao();
        $senha = sha1($senha);
        $consulta = $conexao->getconexao()->prepare('update admin set nome=:nome,email=:email,senha=:senha where id=1');
        $consulta->execute(array(
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha,
        ));
    }

    public function Existe_departamento1($nome, $id) {
        $conexao = new conexao();
        $consulta = $conexao->getconexao()->prepare('select * from departamento where nome=:nome and Id_Departamento!=:id');
        $consulta->execute(array(
            ':nome' => $nome,
            ':id' => $id
        ));
        return $consulta->rowCount();
    }

    public function Existe_usuario1($usuario, $id) {
        $conexao = new conexao();
        $consulta = $conexao->getconexao()->prepare('select * from departamento where Usuario=:usuario and Id_Departamento !=:id');
        $consulta->execute(array(
            ':usuario' => $usuario,
            ':id' => $id
        ));
        return $consulta->rowCount();
    }

    public function Existe_departamento($nome) {
        $conexao = new conexao();
        $consulta = $conexao->getconexao()->prepare('select * from departamento where nome=:nome');
        $consulta->execute(array(
            ':nome' => $nome,
        ));
        return $consulta->rowCount();
    }

    public function Existe_usuario($usuario) {
        $conexao = new conexao();
        $consulta = $conexao->getconexao()->prepare('select * from departamento where Usuario=:usuario');
        $consulta->execute(array(
            ':usuario' => $usuario,
        ));
        return $consulta->rowCount();
    }

    public function add_departamento($nome, $usuario, $email ,$senha) {
        $conexao = new conexao();
        $senha  = sha1($senha);
        $add = $conexao->getconexao()->prepare("insert into departamento(nome,usuario,email,senha) values(:nome,:usuario,:email,:senha)");
        $add->execute(array(
            ':nome' =>$nome,
            ':usuario' =>$usuario,
            ':email'=>$email,
            ':senha'=>$senha
        ));
    }

    public function deletar_departamento($id) {
        $conexao = new conexao();
        $queries = $conexao->getconexao()->prepare('delete from departamento where Id_Departamento=:id');
        $queries->execute(array(
            ':id' => $id
        ));

        $queries = $conexao->getconexao()->prepare('select *from  funcionario where Id_departamento=:id');
        $queries->execute(array(
            ':id' => $id
        ));

        for (; $linha = $queries->fetch();):
            $id_funcionario = $linha['ID_funcionario '];
        endfor;


        $queries = $conexao->getconexao()->prepare('delete from funcionario where Id_departamento=:id');
        $queries->execute(array(
            ':id' => $id
        ));

        $queries = $conexao->getconexao()->prepare('delete from processo where 	ID_funcionario =:id');
        $queries->execute(array(
            ':id' => $id_funcionario
        ));
    }


    public function add_funcionario($nome,$apelido,$sexo,$telefone,$endereco , $email , $senha ,$funcao ,$id){
         $conexao = new conexao();
         $senha =sha1($senha);
         $add=$conexao->getconexao()->prepare('insert into funcionario(Nome,Apelido ,Sexo ,Telefone ,Endereco,Email, Senha ,Funcao ,Id_departamento)
         values(:nome , :apelido ,:sexo,:telefone,:endereco,:email,:senha,:funcao,:id)');
       $add->execute(
              array(
                ':nome'=>$nome ,
                ':apelido'=>$apelido , 
                ':sexo'=>$sexo , 
                ':telefone'=>$telefone , 
                ':endereco'=>$endereco , 
                ':email'=>$email , 
                ':senha'=>$senha, 
                ':funcao'=>$funcao,
                ':id'=>$id    
              )
              );

    }

    public function email_existe_funcionario($email, $id){
           $conexao = new conexao();
           $add = $conexao->getconexao()->prepare('select * from funcionario where Email=:email and ID_funcionario!=:id');
           $add->execute(array(
                 ':email'=>$email ,
                 ':id'=>$id
           ));

           return $add->rowCount();
    }

    public function telefone_existe_funcionario($telefone , $id){
        $conexao = new conexao();
        $add = $conexao->getconexao()->prepare('select * from funcionario where Telefone=:telefone and ID_funcionario!=:id');
        $add->execute(array(
              ':telefone'=>$telefone,
              ':id'=>$id
        ));
        return $add->rowCount();
 }

 public function Existe_email_deparatamento($email){
      $conexao = new conexao();
      $add =  $conexao->getconexao()->prepare("select * from  departamento  where email=:email");
      $add->execute(array(
           ':email'=>$email
      ));
      return $add->rowCount();
 }

 public function busca_id($departamento){
       $conexao = new conexao();
       $add = $conexao->getconexao()->prepare('select * from departamento where Nome=:nome');
       $add->execute(array(
            ':nome'=>$departamento
       ));
      
       while($linha =$add->fetch()):
           $id =$linha['Id_Departamento'];
       endwhile;

       return $id;
 }

 public function update_funcionario ($nome,$apelido,$sexo,$telefone,$endereco , $email , $senha ,$funcao ,$id_depart ,$id){
    $conexao = new conexao();
    $senha =sha1($senha);
    $add =$conexao->getconexao()->prepare('update funcionario set Nome=:nome,Apelido=:apelido,Sexo=:sexo,Telefone=:telefone,Endereco=:endereco,Email=:email,Senha=:senha,Funcao=:funcao,Id_departamento=:id_depar where ID_funcionario=:id');
    $add->execute(array(
        ':nome'=>$nome ,
        ':apelido'=>$apelido , 
        ':sexo'=>$sexo , 
        ':telefone'=>$telefone , 
        ':endereco'=>$endereco , 
        ':email'=>$email , 
        ':senha'=>$senha, 
        ':funcao'=>$funcao,
        ':id_depar'=>$id_depart,
        ':id'=>$id 
    ));
 }

 public function deletar_funcionario($id){
       $conexao =new conexao();
       $add=  $conexao->getconexao()->prepare('delete  from funcionario where ID_funcionario=:id');
       $add->execute(array(
           ':id'=>$id
       ));

       $add1 = $conexao->getconexao()->prepare('delete from processo where Idfuncionario=:id');
       $add1->execute(array(
            ':id'=>$id
       ));



 }


 public function email_existe_funcionario1($email){
    $conexao = new conexao();
    $add = $conexao->getconexao()->prepare('select * from funcionario where Email=:email ');
    $add->execute(array(
          ':email'=>$email ,
           
    ));

    return $add->rowCount();
}

public function telefone_existe_funcionario1($telefone){
 $conexao = new conexao();
 $add = $conexao->getconexao()->prepare('select * from funcionario where Telefone=:telefone');
 $add->execute(array(
       ':telefone'=>$telefone,
       
 ));
 return $add->rowCount();
}

 public  function  update_email_departamento($email,$id){
       $conexao =new conexao();
       $add =$conexao->getconexao()->prepare("select * from departamento where email=:email and Id_Departamento !=:id");
       $add->execute(array(
            ':id'=>$id,
            ':email'=>$email
       ));
        
       return $add->rowCount();
}

public  function update_departamento($email , $senha,$id){
     $conexao =new conexao();
     $senha=sha1($senha);
     $add = $conexao->getconexao()->prepare("update departamento set Email=:email,Senha=:senha where Id_Departamento=:id");
     $add->execute(array(
          ':id'=>$id,
          ':email'=>$email,
          ':senha'=>$senha
     ));
}

    

}
