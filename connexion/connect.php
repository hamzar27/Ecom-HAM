<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=mp", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('SET NAMES utf8');
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>