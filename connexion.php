<?php
    try {
        $strconn = 'mysql:host=localhost;dbname=GESTIONHORAIRE';
        $pdo = new PDO($strconn, 'root', '');
    } catch (PDOException $e) {
        $msg = 'ERREUR PDO dans ' . $e->getMessage();
        die($msg);
    }
?>