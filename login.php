<?php
session_start();
require ('connexion/connect.php');
require('loader.php');


if(Client::isconnected()){
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}

if(isset($_POST['sub'])){
    if(Client::client_exist($_POST['username'],$_POST['password'])){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['username'];
        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
    }
    else {
        echo "<script>alert('connexion non reussi');</script>";
    }
}

?>

<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8" />
	<style>
    body { background-image: url('cb.png');
      
    }
    </style>
	
</head>
<body >
	
	<div class="cg">
		<div class="Container-fluid">
		<!-- Header -->
		
			<?php include('includes/header.php'); ?>
		<!--Body-->
		  <div class="Container-fluid">
                <center>
              <div class="panel panel-default" style="width:500px;">  
                <div class="panel-heading">  
                    <strong>Se Connecter</strong>
                </div>  
                <div class="panel-body">  
                        <form method="post" action="login.php" style="width:300px">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required="required" /><br>
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required="required" /><br>
                            <input type="submit" value="Connexion" class="btn btn-primary" name="sub" />
                            
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