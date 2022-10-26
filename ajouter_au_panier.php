<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Client)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

if(isset($_POST['sub'])){
    
    if(!isset($_GET['ida']) || empty($_GET['ida']) || empty($_POST['qt']) || $_POST['qt']<=0) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
    else{
        $req = $conn->prepare("insert into paniers(id_article,id_user,qt) values (:ida,:idu,:qt)");
        $req->execute(array(
            "ida" => intval($_GET['ida']),
            "idu" => $user->getid(),
            "qt" => $_POST['qt']
        ));
        echo "<script type='text/javascript'>document.location.replace('mon_panier.php');</script>";
    }
    
}
else {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}

?>
