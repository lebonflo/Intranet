<?php
// $servername = "";
// $username = "";
// $password = "";
// try {
//     $conn = new PDO("mysql:host=$servername;dbname=lptent", $username, $password);
// } catch (PDOException $e) {
//     echo 'Connexion échouée : ' . $e->getMessage();
// }
$servername = "localhost";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=workspace;charset=utf8", $username, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
?>