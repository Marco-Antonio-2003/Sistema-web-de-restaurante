<?php 

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }
  }
    if (count($_POST) >0) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    
        $servername = "localhost";
        $username = "root";
        $password = "";
    
        try {
        $conn = new PDO("mysql:host=$servername;dbname=restaurante_bd", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexão: ok";
    
        $stmt = $conn->prepare("SELECT codigo FROM usuario WHERE email=:email and senha=md5(:senha)");
        $stmt ->bindParam(':email',$email, PDO::PARAM_STR);
        $stmt ->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        
    
        // set the resulting array to associative
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $qtd_usuarios = count($r);
        if($qtd_usuarios ==1){
            $resultado["msg"] = "Usuario encontrado";
            $resultado ["cod"] = 1;
        } else if($qtd_usuarios ==0) {
            $resultado["msg"] = "Email e senha NÃO encontrado...";
            $resultado["cod"] = 0;
        }
        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          echo $v;
        }
    
        } catch(PDOException $e) {
        echo "Conexão: falhou: " . $e->getMessage();
        }
        $conn = null;
    
    }

    include("index.php"); // isso faz n ir na outra pagina php
?>