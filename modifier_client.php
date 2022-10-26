<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Admin) || !isset($_GET['id'])) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";





?>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8" />
   
	
	
</head>
<body>
	
	<div class="cg">
		<div class="Container-fluid">
		<!-- Header -->
		
			<?php include('includes/header.php'); ?>
		<!--Body-->
            <?php $client = Client::getclientbyid($_GET['id']); ?>
		  <div class="Container-fluid">
              <center>
            <div class="panel panel-default" style="width:500px;">  
                <div class="panel-heading">  
                   <strong>Client</strong>
                </div>  
                <div class="panel-body">  
                        <form method="post" action="trait_mod_client.php?id=<?php echo $client->getid(); ?>" style="width:300px" enctype="multipart/form-data">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required="required" value="<?php echo $client->getusername(); ?>" /><br>
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" required="required" value="<?php echo $client->getpassword(); ?>" /><br>
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $client->getnom(); ?>" /><br>
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required="required" value="<?php echo $client->getprenom(); ?>" /><br>
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required="required" value="<?php echo $client->getemail(); ?>" /><br>
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required="required" value="<?php echo $client->getadresse(); ?>" /><br>
                            <label for="tel">Tel</label>
                            <input type="tel" class="form-control" id="tel" name="tel" required="required" value="<?php echo $client->gettel(); ?>" /><br>
                            
                            <input type="submit" value="Valider" class="btn btn-primary" name="sub" />
                            
                            
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