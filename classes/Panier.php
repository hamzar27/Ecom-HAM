<?php

class Panier{
    private $id;
    private $id_article;
    private $qt;
    
    public function Panier($id_article,$qt){
        $this->id_article = $id_article;
        $this->qt = $qt;
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