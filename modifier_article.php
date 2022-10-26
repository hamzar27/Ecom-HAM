<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Admin) || !isset($_GET['id']) || !isset($_GET['t']) || !isset($_GET['m'])) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";





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
            <?php $article = Article::getarticlebyid($_GET['id']); ?>
		  <div class="Container-fluid">
              <center>
            <div class="panel panel-default" style="width:500px;">  
                <div class="panel-heading">  
                   <strong>Article</strong>
                </div>  
                <div class="panel-body">  
                        <form method="post" action="trait_mod_article.php?id=<?php echo $article->getid(); ?>" style="width:300px" enctype="multipart/form-data">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required="required" value="<?php echo $article->gettitle(); ?>" /><br>
                            <label for="img">Image</label>
                            <input type="file" class="form-control" id="img" name="image" /><br>
                            <label for="prix">Prix</label>
                            <input type="number" class="form-control" id="prix" name="prix" value="<?php echo $article->getprix(); ?>" /><br>
                            <label>Catégorie</label>
                            <select name="categorie" class="form form-control">
                            <?php $categories = Article::getcategories(); ?>
                            <?php foreach($categories as $categorie){ ?>
                                <?php if($categorie->getnom()==$article->getcategorie()){ ?>
                                <option value="<?php echo $categorie->getid(); ?>" selected="selected"><?php echo $categorie->getnom(); ?></option>
                                <?php } else{ ?>
                                 <option value="<?php echo $categorie->getid(); ?>"><?php echo $categorie->getnom(); ?></option>
                                <?php } ?>
                            <?php } ?>
                            </select><br>
                            <label for="couleur">Couleur</label>
                            <input type="text" class="form-control" id="couleur" name="couleur" required="required" value="<?php echo $article->getcouleur(); ?>" /><br>
                            <label>Taille</label>
                            <select name="taille" class="form form-control">
                                <?php 
                                    $i = 0;
                                    if($_GET['t']=="S") $i = 1;
                                    if($_GET['t']=="M") $i = 2;
                                    if($_GET['t']=="L") $i = 3;
                                ?>
                                <option value="1" <?php if($i==1) echo "selected"; ?>>Small</option>
                                <option value="2" <?php if($i==2) echo "selected"; ?>>Medium</option>
                                <option value="3" <?php if($i==3) echo "selected"; ?>>Large</option>
                            </select><br>
                            <label>Mode</label>
                            <select name="mode" class="form form-control">
                                <?php 
                                    $i = 0;
                                    if($_GET['m']=="homme") $i = 1;
                                    if($_GET['m']=="femme") $i = 2;
                                    if($_GET['m']=="enfant") $i = 3;
                                ?>
                                <option value="1" <?php if($i==1) echo "selected"; ?>>Homme</option>
                                <option value="2" <?php if($i==2) echo "selected"; ?>>Femme</option>
                                <option value="3" <?php if($i==3) echo "selected"; ?>>Enfant</option>
                            </select><br>
                            
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