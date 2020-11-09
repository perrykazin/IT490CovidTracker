<?php
    $dsn = 'mysql:host=localhost;dbname=user_credentials';
    $username = 'root';
    $password = 'it490Group2!!!';

    try {
        $con = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/err.php');
        exit();
    }
?>