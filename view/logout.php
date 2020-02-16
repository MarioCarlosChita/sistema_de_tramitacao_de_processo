<?php

if ($_GET['funcao'] == "sair"):

    session_start();
    $usuario = $_SESSION['admin'];
    if (!empty($usuario)):
        $_SESSION['admin'] = null;
        session_destroy();
    
        header('location:../index.html');
    endif;



endif;


if($_GET['funcao'] =="sair-funcionario"):
    session_start();
    $usuario = $_SESSION['funcionario'];
    if (!empty($usuario)):
        $_SESSION['admin'] = null;
        $_SESSION['id'] = null ; 
        session_destroy();
        header('location:../index.html');
    endif;

endif;    


if($_GET['funcao'] =="sair-departamento"):
    session_start();
    $usuario = $_SESSION['departamento'];
    if (!empty($usuario)):
        $_SESSION['departamento'] = null;
        $_SESSION['id'] = null ; 
        session_destroy();
        header('location:../index.html');
    endif;

endif; 


?>

