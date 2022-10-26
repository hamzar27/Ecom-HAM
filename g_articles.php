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
                  <div>
                    <a href="ajouter_article.php"><button class="btn btn-secondary btn-md">
                            <strong style="color:black">Ajouter un article</strong>
                    </button></a>
                  </div><br>
               <div class="panel panel-default" style="width:500px;">  
                <div class="panel-heading">  
                    <strong>Séléctionnez un article :</strong>
                </div>  
                <div class="panel-body">  
                        <form method="get" action="g_articles.php">
                    <select name="article" class="form form-control">
                    <option value="0">Articles</option>
                    <?php $result = $conn->query("select * from articles"); ?>
                      <?php while($article = $result->fetch()){ ?>
                        <option value="<?php echo $article['id']; ?>"><?php echo $article['title']; ?></option>
                    <?php } ?>
                    </select><br>
                        <input type="submit" name="sub" class="btn btn-primary" />
                    </form>
                </div>   
              </div> 
              </center>
              <?php if(isset($_GET['sub'])){ ?>
              <?php            if($_GET['article']!=0){ ?>
                                    <?php $article = Article::getarticlebyid($_GET['article']); ?>
                                    <table class="table table-hover">
                                        <tr>
                                            <td><img src="images/articles_images/<?php echo $article->getimage(); ?>" width="150px" heghit="150px" /></td>
                                            <td><strong><?php echo $article->gettitle(); ?></strong><br>
                                                Couleur : <?php echo $article->getcouleur(); ?><br>Taille : <?php echo $article->gettaille(); ?><br>
                                                Mode : <?php echo $article->getmode(); ?><br>Catégorie : <?php echo $article->getcategorie(); ?><br>
                                                Prix : <?php echo $article->getprix(); ?> DHs
                                            </td>
                                            <td>
                                                <a href="modifier_article.php?id=<?php echo $article->getid(); ?>&t=<?php echo $article->gettaille(); ?>&m=<?php echo $article->getmode(); ?>"><button class="btn btn-primary">Modifier cet article</button></a>
                                                <a href="supprimer_article.php?id=<?php echo $article->getid(); ?>"><button class="btn btn-danger">Supprimer cet article</button></a>
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
