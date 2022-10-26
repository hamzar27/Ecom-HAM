<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!isset($_GET['id']) || !(Client::isconnected()) || !($user instanceof Admin)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

if(isset($_POST['sub'])){
    
    $client = new Client($_POST['username'],$_POST['password'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['adresse'],$_POST['tel']);
    $client->setid($_GET['id']);
    
    $req = $conn->prepare("update users set username = ?,password = ?,nom = ?,prenom = ?,email = ?,adresse = ?,tel = ? where id = ?");
    
    $req->execute([$client->getusername(),$client->getpassword(),$client->getnom(),$client->getprenom(),$client->getemail(),$client->getadresse(),$client->gettel(),$client->getid()]);
    
    $conn=null;
    echo "<script>alert('Opération réussi')</script>";
    echo "<script type='text/javascript'>document.location.replace('g_clients.php');</script>";
    
    //$res = $conn->query("select * from users where id = ".$_GET['id'])->fetch();
    
    //Client::supprimer_clientbyid($_GET['id']);
    
    //$client = new Article($_POST['username'],$image,$_POST['prix'],$_POST['couleur'],Article::settaille($_POST['taille']),Article::setmode($_POST['mode']));
    //$article->setcategorie($_POST['categorie']);
    //$article->ajouter_article();
    //$conn=null;
    //echo "<script>alert('Opération réussi')</script>";
    //echo "<script type='text/javascript'>document.location.replace('g_articles.php');</script>";
    
}







?>