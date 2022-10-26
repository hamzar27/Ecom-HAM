<?php


class Client{
    private $id;
    private $username;
    private $password;
    private $nom;
    private $prenom;
    private $email;
    private $adresse;
    private $tel;
    
    public function Client($username,$password,$nom,$prenom,$email,$adresse,$tel){
        $this->username = $username;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->tel = $tel;
    }
    public function setid($id){
        $this->id = $id;
    }
    public function getid(){
        return $this->id;
    }
    public function getusername(){
        return $this->username;
    }
    public function getpassword(){
        return $this->password;
    }
    public function getnom(){
        return $this->nom;
    }
    public function getprenom(){
        return $this->prenom;
    }
    public function getemail(){
        return $this->email;
    }
    public function getadresse(){
        return $this->adresse;
    }
    public function gettel(){
        return $this->tel;
    }
    public function addclient(){
        include('connexion/connect.php');
        $req = $conn->prepare("insert into users(username,password,nom,prenom,email,adresse,tel,role) values(:username,:password,:nom,:prenom,:email,:adresse,:tel,:role)");
        $req->execute(array(
            "username" => $this->username,
            "password" => $this->password,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "email" => $this->email,
            "adresse" => $this->adresse,
            "tel" => $this->tel,
            "role" => "client",
        ));
        $conn = null;
    }
    public static function isconnected(){
        if(isset($_SESSION['username']) && isset($_SESSION['password'])) return true;
        return false;
    }
    
    public static function client_exist($username,$password){
        include('connexion/connect.php');
        $result = $conn->query("select * from users where username = \"$username\" AND password = \"$password\"")->fetch();
        $conn = null;
        if($result==false) return false;
        return true;
    }
    public static function getclientbyid($id){
        include('connexion/connect.php');
        $cl = $conn->query("select * from users where id = $id")->fetch();
        $client = new Client($cl['username'],$cl['password'],$cl['nom'],$cl['prenom'],$cl['email'],$cl['adresse'],$cl['tel']);
        $client->setid($id);
        $conn = null;
        return $client;
    }
    public static function supprimer_clientbyid($id){
        include('connexion/connect.php');
        $req = $conn->prepare("delete from users where id = :idc");
        $req->execute(array(
            "idc" => $id,
        ));
        $conn = null;
    }
    public function has_panier(){
        include('connexion/connect.php');
        $res = $conn->query("select * from paniers where id_user = $this->id")->fetch();
        $conn = null;
        if($res==false) return false;
        return true;
        
    }
    public function getpaniers(){
        include('connexion/connect.php');
        $paniers = array();
        $i=0;
        $res = $conn->query("select * from paniers where id_user = $this->id");
        while($panier=$res->fetch()){
            $paniers[$i] = new Panier($panier['id_article'],$panier['qt']);
            $i++;
        }
        $conn =null;
        return $paniers;
    }
    public function has_commande(){
        include('connexion/connect.php');
        $res = $conn->query("select * from commandes where id_user = $this->id")->fetch();
        $conn = null;
        if($res==false) return false;
        return true;
        
    }
    public function getcommandes(){
        include('connexion/connect.php');
        $commandes = array();
        $i=0;
        $res = $conn->query("select * from commandes where id_user = $this->id");
        while($commande=$res->fetch()){
            $commandes[$i] = new Commande($commande['id_article'],$commande['qt'],$commande['date']);
            $i++;
        }
        $conn =null;
        return $commandes;
    }
    
    
}


?>