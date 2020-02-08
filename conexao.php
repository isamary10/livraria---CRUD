<?php
    $dsn = "mysql:host=localhost;dbname=livraria;charset=utf8mb4;port=3307";
    $username = "root";
    $password = "";
    
    try {
        $conexaoDB = new PDO($dsn, $username, $password);
        echo "<h1>Deu certo!</h1>";
    } catch(PDOException $e){
        echo "<h1>Nessa máquina não funciona!</h1>".$e->getMessage();
    };
?>