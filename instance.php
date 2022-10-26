<?php


if(Client::isconnected()){
    $result = $conn->query("select * from users where username = \"".$_SESSION['username']."\"")->fetch();
    
    
    if($result['role']=="client"){
        $user = new Client($result['username'],$result['password'],$result['nom'],$result['prenom'],$result['email'],$result['adresse'],$result['tel']);
        $user->setid($result['id']);
    }
    else if($result['role']=="admin"){
        $user = new Admin($result['username'],$result['password'],$result['nom'],$result['prenom'],$result['email'],$result['adresse'],$result['tel']);
        $user->setid($result['id']);
    }
    
}




?>