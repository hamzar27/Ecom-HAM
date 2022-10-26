<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Client)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

if(!isset($_GET['ida']) || empty($_GET['ida'])) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

else{
    $req = $conn->prepare("delete from paniers where id_article = :ida AND id_user = :idu");
    $req->execute(array(
        "ida" => $_GET['ida'],
        "idu" => $user->getid()
    ));
    echo "<script type='text/javascript'>document.location.replace('mon_panier.php');</script>";
}


?>