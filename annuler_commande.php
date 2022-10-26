<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Client)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";


if(!isset($_GET['id'])) "<script type='text/javascript'>document.location.replace('index.php');</script>";

else{
    $req = $conn->prepare("delete from commandes where id_article = :ida AND id_user = :idu");
    $req->execute(array(
        "ida" => $_GET['id'],
        "idu" => $user->getid()
    ));
    echo "<script type='text/javascript'>document.location.replace('mes_commandes.php');</script>";
    
}
$conn =null;



?>