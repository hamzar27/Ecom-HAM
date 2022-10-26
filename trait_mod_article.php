<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!isset($_GET['id']) || !(Client::isconnected()) || !($user instanceof Admin)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

if(isset($_POST['sub'])){
    $res = $conn->query("select * from articles where id = ".$_GET['id'])->fetch();
    $image = $res['img'];
   
    if($_FILES['image']['name']!=""){
        unlink("images/articles_images/".$image);
        $image = (Article::nbr_article()+1)."-".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'images/articles_images/'.$image);
    }
    $article = new Article($_POST['title'],$image,$_POST['prix'],$_POST['couleur'],Article::settaille($_POST['taille']),Article::setmode($_POST['mode']));
    $article->setid($_GET['id']);
    
    
    $req = $conn->prepare("update articles set title = ?,img = ?,prix = ?,id_categorie = ?,couleur = ?,taille = ?,mode = ? where id = ?");
    $req->execute([$article->gettitle(),$article->getimage(),$article->getprix(),$article->getidcategorie(),$article->getcouleur(),$article->gettaille(),$article->getmode(),$article->getid()]);
    
    
    $conn=null;
    echo "<script>alert('Opération réussi')</script>";
    echo "<script type='text/javascript'>document.location.replace('g_articles.php');</script>";
    
}







?>