<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Client)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

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
		  <div class="container-fluid" style="margin-top:20px;">
              <center>
              
              <!--Articles-->
              
              <?php if($user->has_commande()==false){ ?>
                  <br><br>
                <h1>Vous n'avez aucune commande !</h1>
                  <br><br>
                
              <?php } else{ ?>
                <?php  $commandes = $user->getcommandes();  ?>
                  
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="2"></th>
                            <th colspan="2">Nom</th>
                            <th colspan="2">Couleur</th>
                            <th colspan="2">Taille</th>
                            <th colspan="2">Mode</th>
                            <th colspan="2">Catégorie</th>
                            <th colspan="2">Prix</th>
                            <th colspan="2">Quantité</th>
                            <th colspan="2">Date</th>
                            <th colspan="2">Prix * Quantité</th>
                            <th colspan="2">Action</th>
                            
                        
                        </tr>
                    
                    
                    </thead>
                    <tbody>
                        <?php 
				$tot = 0;
				foreach($commandes as $commande){ ?>
                            <?php $article = $commande->getarticle(); ?>
                        <tr>
                               <td><img src="images/articles_images/<?php echo $article->getimage(); ?>" width="50" height="50" /><td>
                                <td><?php echo $article->gettitle(); ?><td>
                                <td><?php echo $article->getcouleur(); ?><td>
                                <td><?php echo $article->gettaille(); ?><td>
                                <td><?php echo $article->getmode(); ?><td>
                                <td><?php echo $article->getcategorie(); ?><td>
                                <td><?php echo $article->getprix(); ?><td>
                                <td><?php echo $commande->getqt(); ?><td>
                                <td><?php echo $commande->getDate(); ?><td>
                                <td><?php echo $commande->getqt()*$article->getprix(); ?><td>
                                <td>
                                    <a href="annuler_commande.php?id=<?php echo $article->getid(); ?>"><button class="btn btn-danger" style="margin-right:5px;">Annuler la commande</button></a>
                                <td>
                                <?php $tot = $tot + $commande->getqt()*$article->getprix(); ?>
                            </tr>
                    
                        <?php } ?>
			    <tr>
                                <td colspan="21"><?php echo "<b>Total : ".$tot." Dhs</b>"; ?><td>
                            </tr>
                        
                    </tbody>
                   
                </table>  
             
              <?php } ?>
                  </center>
		  </div>

		<!--Footer -->
		<?php include('includes/footer.php'); ?>
	   </div>


	</div>
<?php $conn = null; ?>	
    
</body>
</html>


                               
