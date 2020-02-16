<?php

class conexao {

     public function getconexao() {
        try {
            $PDO = new PDO("mysql:host=localhost;dbname=projecto", "root", "");
        } catch (Exception $ex) {
            echo "error de conexao com banco de dados :" . $ex->getMessage();
        }
        return $PDO;
    }

}
