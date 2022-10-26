<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!isset($_GET['id']) || !(Client::isconnected()) || !($user instanceof Admin)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";


    $res = $conn->query("select * from articles where id = ".$_GET['id'])->fetch();
    
    $image = $res['img'];
    Article::supprimer_articlebyid($_GET['id']);
    unlink("images/articles_images/".$image);
    echo "<script>alert('Opération réussi')</script>";
    echo "<script type='text/javascript'>document.location.replace('g_articles.php');</script>";
    

$conn=null;





?>