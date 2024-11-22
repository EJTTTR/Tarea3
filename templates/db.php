<?php
$servername = "127.0.0.1";
$username = "root";
$password = "0408";
$dbname = "dblibreria";
$port = 3306; 

try {
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}


// $servername = "sql108.infinityfree.com";
// $username = "if0_36976566";
// $password = "6l3LjAHZV7PXt";
// $dbname = "if0_36976566_dblibreria";
// $port = 3306; 

// try {
//     $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//     echo "Error de conexión a la base de datos: " . $e->getMessage();
// }