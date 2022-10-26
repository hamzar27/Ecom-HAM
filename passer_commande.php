<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Client)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

if(!isset($_GET['ida']) || !isset($_GET['qt'])) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

else{
    $y = "20".date('y');
    $m = date('m');
    $d = date('d');
    $date = $d."-".$m."-".$y;
    $req = $conn->prepare("insert into commandes(id_article,id_user,qt,date) values (:ida,:idu,:qt,:date)");
    $req->execute(array(
        "ida" => $_GET['ida'],
        "idu" => $user->getid(),
        "qt" => $_GET['qt'],
        "date" => $date
    ));
    $req2 = $conn->prepare("delete from paniers where id_article = :ida AND id_user = :idu");
    $req2->execute(array(
        "ida" => $_GET['ida'],
        "idu" => $user->getid()
    ));
    echo "<script type='text/javascript'>document.location.replace('mon_panier.php');</script>";

    
}
$conn =null;