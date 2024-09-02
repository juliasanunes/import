<?php

// Início da conexão com o banco de dados utilizando PDO
$host = "192.168.100.14"; // ou o nome/IP do servidor
$user = "sa";
$pass = "s@s@";
$dbname = "Transferencia";
$port = 1433; // Porta padrão para SQL Server

try {
    // Conexão com a porta especificada (opcional)
    //$conn = new PDO("sqlsrv:Server=$host,$port;Database=$dbname", $user, $pass);

    // Conexão sem a especificação da porta (a porta padrão será usada)
    $conn = new PDO("sqlsrv:Server=$host;Database=$dbname", $user, $pass);

    // Definindo o modo de erro do PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Conexão com o banco de dados realizada com sucesso.";
} catch (PDOException $err) {
    echo "Erro: Conexão com o banco de dados não realizada com sucesso. Erro gerado: " . $err->getMessage();
}
?>
