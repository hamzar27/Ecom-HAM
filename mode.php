<?php
session_start();
require ('connexion/connect.php');
require('loader.php');
include('instance.php');

if($_GET['mode']!=1 && $_GET['mode']!=2 && $_GET['mode']!=3 && $_GET['mode']!=4) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

?>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8" />
	<script src="js/script.js"></script>
	
</head>
<body>
	
	<div class="cg">
		<div class="Container-fluid">
		<!-- Header -->
		
			<?php include('includes/header.php'); ?>
		<!--Body-->
		  <div class="Container-fluid">
              <!--Menu-->
              
              <?php include('includes/menu.php'); ?>
              
              <!--Articles-->
              <center>
              <div style="display:inline;float:right;margin-right:50px;width:1200px;margin-top:20px;">
                  <table class="table table-hover">
                <?php 
                    if($_GET['mode']==1) $articles = Article::articleFemme();
                    else if($_GET['mode']==2) $articles = Article::articleHomme(); 
                    else if($_GET['mode']==3) $articles = Article::articleEnfant();
                    else if($_GET['mode']==4){
                        
                        if($_POST['categorie']==0 && $_POST['couleur']=="all" && $_POST['taille']==0 && $_POST['prix']==0 && $_POST['mode']==0) 
                            $articles = Article::getrandomarticles();
                        else if($_POST['categorie']==0 && $_POST['couleur']=="all" && $_POST['taille']==0 && $_POST['prix']==0 && $_POST['mode']!=0) 
                            $articles = Article::articles_by_mode($_POST['mode']);
                        else if($_POST['categorie']==0 && $_POST['couleur']=="all" && $_POST['taille']==0 && $_POST['prix']!=0 && $_POST['mode']==0) 
                            $articles = Article::articles_by_prix($_POST['prix']);
                        else if($_POST['categorie']==0 && $_POST['couleur']=="all" && $_POST['taille']==0 && $_POST['prix']!=0 && $_POST['mode']!=0) 
                            $articles = Article::articles_by_prix_mode($_POST['prix'],$_POST['mode']);
                        else if($_POST['categorie']==0 && $_POST['couleur']=="all" && $_POST['taille']!=0 && $_POST['prix']==0 && $_POST['mode']==0)
                            $articles = Article::articles_by_taille($_POST['taille']);
                        else if($_POST['categorie']==0 && $_POST['couleur']=="all" && $_POST['taille']!=0 && $_POST['prix']==0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_taille_mode($_POST['taille'],$_POST['mode']);
                        else if($_POST['categorie']==0 && $_POST['couleur']=="all" && $_POST['taille']!=0 && $_POST['prix']!=0 && $_POST['mode']==0)
                            $articles = Article::articles_by_prix_taile($_POST['prix'],$_POST['taille']);
                        else if($_POST['categorie']==0 && $_POST['couleur']=="all" && $_POST['taille']!=0 && $_POST['prix']!=0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_taille_prix_mode($_POST['taille'],$_POST['prix'],$_POST['mode']);
                        else if($_POST['categorie']==0 && $_POST['couleur']!="all" && $_POST['taille']==0 && $_POST['prix']==0 && $_POST['mode']==0)
                            $articles = Article::articles_by_color($_POST['couleur']);
                         else if($_POST['categorie']==0 && $_POST['couleur']!="all" && $_POST['taille']==0 && $_POST['prix']==0 && $_POST['mode']!=0)
                             $articles = Article::articles_by_color_mode($_POST['couleur'],$_POST['mode']);
                        else if($_POST['categorie']==0 && $_POST['couleur']!="all" && $_POST['taille']==0 && $_POST['prix']!=0 && $_POST['mode']==0)
                            $articles = Article::articles_by_color_prix($_POST['couleur'],$_POST['prix']);
                        else if($_POST['categorie']==0 && $_POST['couleur']!="all" && $_POST['taille']==0 && $_POST['prix']!=0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_mode_prix_couleur($_POST['mode'],$_POST['prix'],$_POST['couleur']);
                        else if($_POST['categorie']==0 && $_POST['couleur']!="all" && $_POST['taille']!=0 && $_POST['prix']==0 && $_POST['mode']==0)
                            $articles = Article::articles_by_couleur_taille($_POST['couleur'],$_POST['taille']);
                        else if($_POST['categorie']==0 && $_POST['couleur']!="all" && $_POST['taille']!=0 && $_POST['prix']==0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_couleur_taille_mode($_POST['couleur'],$_POST['taille'],$_POST['mode']);
                        else if($_POST['categorie']==0 && $_POST['couleur']!="all" && $_POST['taille']!=0 && $_POST['prix']!=0 && $_POST['mode']==0)
                            $articles = Article::articles_by_couleur_taille_prix($_POST['couleur'],$_POST['taille'],$_POST['prix']);
                        else if($_POST['categorie']==0 && $_POST['couleur']!="all" && $_POST['taille']!=0 && $_POST['prix']!=0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_couleur_taille_prix_mode($_POST['couleur'],$_POST['taille'],$_POST['prix'],$_POST['mode']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']=="all" && $_POST['taille']==0 && $_POST['prix']==0 && $_POST['mode']==0)
                            $articles = Article::articles_by_categorie($_POST['categorie']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']=="all" && $_POST['taille']==0 && $_POST['prix']==0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_categorie_mode($_POST['categorie'],$_POST['mode']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']=="all" && $_POST['taille']==0 && $_POST['prix']!=0 && $_POST['mode']==0)
                            $articles = Article::articles_by_categorie_prix($_POST['categorie'],$_POST['prix']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']=="all" && $_POST['taille']==0 && $_POST['prix']!=0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_categorie_prix_mode($_POST['categorie'],$_POST['prix'],$_POST['mode']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']=="all" && $_POST['taille']!=0 && $_POST['prix']==0 && $_POST['mode']==0)
                            $articles = Article::articles_by_categorie_taille($_POST['categorie'],$_POST['taille']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']=="all" && $_POST['taille']!=0 && $_POST['prix']==0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_categorie_taille_mode($_POST['categorie'],$_POST['taille'],$_POST['mode']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']=="all" && $_POST['taille']!=0 && $_POST['prix']!=0 && $_POST['mode']==0)
                            $articles = Article::articles_by_categorie_taille_prix($_POST['categorie'],$_POST['taille'],$_POST['prix']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']=="all" && $_POST['taille']!=0 && $_POST['prix']!=0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_categorie_taille_prix_mode($_POST['categorie'],$_POST['taille'],$_POST['prix'],$_POST['mode']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']!="all" && $_POST['taille']==0 && $_POST['prix']==0 && $_POST['mode']==0)
                            $articles = Article::articles_by_categorie_couleur($_POST['categorie'],$_POST['couleur']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']!="all" && $_POST['taille']==0 && $_POST['prix']==0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_categorie_couleur_mode($_POST['categorie'],$_POST['couleur'],$_POST['mode']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']!="all" && $_POST['taille']==0 && $_POST['prix']!=0 && $_POST['mode']==0)
                            $articles = Article::articles_by_categorie_couleur_prix($_POST['categorie'],$_POST['couleur'],$_POST['prix']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']!="all" && $_POST['taille']==0 && $_POST['prix']!=0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_categorie_couleur_prix_mode($_POST['categorie'],$_POST['couleur'],$_POST['prix'],$_POST['mode']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']!="all" && $_POST['taille']!=0 && $_POST['prix']==0 && $_POST['mode']==0)
                            $articles = Article::articles_by_categorie_couleur_taille($_POST['categorie'],$_POST['couleur'],$_POST['taille']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']!="all" && $_POST['taille']!=0 && $_POST['prix']==0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_categorie_couleur_taille_mode($_POST['categorie'],$_POST['couleur'],$_POST['taille'],$_POST['mode']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']!="all" && $_POST['taille']!=0 && $_POST['prix']!=0 && $_POST['mode']==0)
                            $articles = Article::articles_by_categorie_couleur_taille_prix($_POST['categorie'],$_POST['couleur'],$_POST['taille'],$_POST['prix']);
                        else if($_POST['categorie']!=0 && $_POST['couleur']!="all" && $_POST['taille']!=0 && $_POST['prix']!=0 && $_POST['mode']!=0)
                            $articles = Article::articles_by_categorie_couleur_taille_prix_mode($_POST['categorie'],$_POST['couleur'],$_POST['taille'],$_POST['prix'],$_POST['mode']);
                    }
                      
                ?>
                <?php include('show_articles.php'); ?>
                </table>    
              
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