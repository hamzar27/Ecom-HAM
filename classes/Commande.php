<?php

class Commande{
    private $id;
    private $id_article;
    private $qt;
    private $Date;
    
    public function Commande($id_article,$qt,$date){
        $this->id_article = $id_article;
        $this->qt = $qt;
        $this->Date = $date;
    }
    //Setters && Getters
    public function setid($id){
        $this->id = $id;
    }
    public function getid(){
        return $this->id;
    }
    public function getqt(){
        return $this->qt;
    }
    public function getDate(){
        return $this->Date;
    }
    //Methods
    public function getarticle(){
        include('connexion/connect.php');
        $res = $conn->query("select * from articles where id = $this->id_article")->fetch();
        $article = new Article($res['title'],$res['img'],$res['prix'],$res['couleur'],$res['taille'],$res['mode']);
        $article->setid($res['id']);
        return $article;
    }
    
}


?>
