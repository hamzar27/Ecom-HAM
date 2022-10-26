<?php

class Admin{
    private $id;
    private $username;
    private $password;
    private $nom;
    private $prenom;
    private $email;
    private $adresse;
    private $tel;
    
    public function Admin($username,$password,$nom,$prenom,$email,$adresse,$tel){
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
    public function getusername(){
        return $this->username;
    }
    
    
    
}


?>