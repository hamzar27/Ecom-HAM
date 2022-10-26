<?php
session_start();
require ('connexion/connect.php');
require('loader.php');


if(Client::isconnected()){
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}

if(isset($_POST['sub'])){
    $client = new Client($_POST['username'],$_POST['password'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['adresse'],$_POST['tel']);
    $client->addclient();
    
    $_SESSION['username'] = $client->getusername();
    $_SESSION['password'] = $client->getpassword();
    
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
    
}

?>

<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8" />
	<style>
  body {
    background-image: url('cb.png');
  }
  </style>
	
</head>
<body>
	
	<div class="cg">
		<div class="Container-fluid">
		<!-- Header -->
		
			<?php include('includes/header.php'); ?>
		<!--Body-->
		  <div class="Container-fluid">
            <center>
              <div class="panel panel-default" style="width:500px;">  
                <div class="panel-heading">  
                   <strong>S'inscrire</strong>
                </div>  
                <div class="panel-body">  
                        <form method="post" action="signup.php" style="width:300px">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required="required" /><br>
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required="required" /><br>
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required="required" /><br>
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" /><br>
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required="required" /><br>
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required="required" /><br>
                            <label for="tel">Tel</label>
                            <input type="tel" class="form-control" id="tel" name="tel" required="required" /><br>
                            <input type="submit" value="Valider" class="btn btn-primary" name="sub" />
                            <input type="reset" value="Réinitialiser" class="btn btn-danger" />
                            
                        </form>
                </div>   
              </div> 
            </center>
              
		  </div>

		<!--Footer -->
		<?php include('includes/footer.php'); ?>
	   </div>


	</div>
<?php $conn = null; ?>
</body>
</html>