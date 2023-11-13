<?php 

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }
  }
    if (count($_POST) >0) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    
        try {
        include("conexao_bd.php");

        $conn = new PDO("mysql:host=$servername;dbname=restaurante_bd", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexão: ok";
    
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE situacao= 'Habilitado' AND email=:email and senha=md5(:senha)");
        $stmt ->bindParam(':email',$email, PDO::PARAM_STR);
        $stmt ->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        
    
        // set the resulting array to associative
        $r = $stmt->fetchAll();
        $qtd_usuarios = count($r);
        if($qtd_usuarios ==1){
          session_start();
          $_SESSION["email_usuario"] = $email;
          $_SESSION["nome_usuario"] = $result[0]["nome"];  
          $_SESSION["codigo_usuario"] = $result[0]["codigo"];  
          header("Location: pedido.php");
        } else if($qtd_usuarios ==0) {
            $resultado["msg"] = "Email e senha NÃO encontrado...";
            $resultado["cod"] = 0;
        }
        } catch(PDOException $e) {
        echo "Conexão: falhou: " . $e->getMessage();
        }
        $conn = null;
    
    }
    include("index.php"); // isso faz n ir na outra pagina php
?>