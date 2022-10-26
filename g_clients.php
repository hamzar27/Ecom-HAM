<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Admin)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";


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
		  <div class="Container-fluid">
            
              
              <!--Articles-->
              <center>
                  
               <div class="panel panel-default" style="width:500px;">  
                <div class="panel-heading">  
                    <strong>Séléctionnez un client :</strong>
                </div>  
                <div class="panel-body">  
                        <form method="get" action="g_clients.php">
                    <select name="client" class="form form-control">
                    <option value="0">Clients</option>
                    <?php $result = $conn->query("select * from users where role = \"client\""); ?>
                      <?php while($client = $result->fetch()){ ?>
                        <option value="<?php echo $client['id']; ?>"><?php echo $client['username']; ?></option>
                    <?php } ?>
                    </select><br>
                        <input type="submit" name="sub" class="btn btn-primary" />
                    </form>
                </div>   
              </div> 
              </center>
              <?php if(isset($_GET['sub'])){ ?>
              <?php            if($_GET['client']!=0){ ?>
                                    <?php $client = Client::getclientbyid($_GET['client']); ?>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Username</td>
                                            <td>Password</td>
                                            <td>Nom</td>
                                            <td>Prénom</td>
                                            <td>Email</td>
                                            <td>Adresse</td>
                                            <td>Tel</td>
                                            <td>Admin actions</td>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td>
                                                <?php echo $client->getid(); ?>
                                            </td>
                                            <td>
                                                <?php echo $client->getusername(); ?>
                                            </td>
                                            <td>
                                                <?php echo $client->getpassword(); ?>
                                            </td>
                                            <td>
                                                <?php echo $client->getnom(); ?>
                                            </td>
                                            <td>
                                                <?php echo $client->getprenom(); ?>
                                            </td>
                                            <td>
                                                <?php echo $client->getemail(); ?>
                                            </td>
                                            <td>
                                                <?php echo $client->getadresse(); ?>
                                            </td>
                                            <td>
                                                <?php echo $client->gettel(); ?>
                                            </td>
                                            <td>
                                                <a href="modifier_client.php?id=<?php echo $client->getid(); ?>"><button class="btn btn-primary">Modifier ce client</button></a>
                                                <a href="supprimer_client.php?id=<?php echo $client->getid(); ?>"><button class="btn btn-danger">Supprimer ce client</button></a>
                                            </td>
                                        </tr>
                                    </table>
              
              
              <?php }   ?>
            <?php }   ?>   
              

		  </div>

		<!--Footer -->
		<?php include('includes/footer.php'); ?>
	   </div>


	</div>
<?php $conn = null; ?>	
</body>
</html>
