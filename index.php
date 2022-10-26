<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');


?>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8" />
    <script src="js/script.js"></script>
    <style>
	body {background-image: url('cb.png');

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
              <!--Menu-->
              
              <?php include('includes/menu.php'); ?>
              
              <!--Articles-->
              <center>
              <div style="display:inline;float:right;margin-right:50px;width:1200px;margin-top:20px;">
                  <table class="table table-hover">
                <?php $articles = Article::getrandomarticles(); ?>
                
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
