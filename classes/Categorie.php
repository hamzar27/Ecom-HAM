<?php



class Categorie{
    private $id;
    private $nom;
    
    public function Categorie($id,$nom){
        $this->id = $id;
        $this->nom = $nom;
    }
    public function getid(){
        return $this->id;
    }
    public function getnom(){
        return $this->nom;
    }
    
    public static function getcat($id){
        include('connexion/connect.php');
        $cat = $conn->query("select * from categories where id = $id")->fetch();
        $conn = null;
        return $cat['nom'];
    }
}


?>