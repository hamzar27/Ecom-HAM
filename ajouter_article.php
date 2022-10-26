<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!(Client::isconnected()) || !($user instanceof Admin)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";


if(isset($_POST['sub']) && isset($_POST['title'])){
  
    $imagename = (Article::nbr_article()+1)."-".$_FILES['image']['name'];
    
    
    $article = new Article($_POST['title'],$imagename,$_POST['prix'],$_POST['couleur'],Article::settaille($_POST['taille']),Article::setmode($_POST['mode']));
    
    $article->setcategorie($_POST['categorie']);
    
    $article->ajouter_article();
    move_uploaded_file($_FILES['image']['tmp_name'],'images/articles_images/'.$imagename);
    
    echo "<script>alert('Opération réussi')</script>";
    
    echo "<script type='text/javascript'>document.location.replace('g_articles.php');</script>";
}


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
    
              <center>
              <div class="panel panel-default" style="width:500px;">  
                <div class="panel-heading">  
                   <strong>Article</strong>
                </div>  
                <div class="panel-body">  
                        <form method="post" action="ajouter_article.php" style="width:300px" enctype="multipart/form-data">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required="required" /><br>
                            <label for="img">Image</label>
                            <input type="file" class="form-control" id="img" name="image" required="required" /><br>
                            <label for="prix">Prix</label>
                            <input type="number" class="form-control" id="prix" name="prix" /><br>
                            <label>Catégorie</label>
                            <select name="categorie" class="form form-control">
                            <?php $categories = Article::getcategories(); ?>
                            <?php foreach($categories as $categorie){ ?>
                                <option value="<?php echo $categorie->getid(); ?>"><?php echo $categorie->getnom(); ?></option>
                            <?php } ?>
                            </select><br>
                            <label for="couleur">Couleur</label>
                            <input type="text" class="form-control" id="couleur" name="couleur" required="required" /><br>
                            <label>Taille</label>
                            <select name="taille" class="form form-control">
                                <option value="1">Small</option>
                                <option value="2">Medium</option>
                                <option value="3">Large</option>
                            </select><br>
                            <label>Mode</label>
                            <select name="mode" class="form form-control">
                                <option value="1">Homme</option>
                                <option value="2">Femme</option>
                                <option value="3">Enfant</option>
                            </select><br>
                            
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
