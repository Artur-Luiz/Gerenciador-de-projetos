<?php

    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = 'root';
    $dbName = 'db';

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName, 8111);

    // if ($conn->connect_errno) {
    //     echo "Erro";
    // }
    // else{
    //     echo "Conectado com sucesso";
    // }
    
?>