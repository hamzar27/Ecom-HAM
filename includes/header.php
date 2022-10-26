<div class="Container-fluid">
				<div style="display: inline;float: left;">
					<span style="margin-right: 450px;"><a href="index.php"><img src="images/logo.png" height="70px" /></a></span>
					<span><img src="images/Bienvenue.gif" height="70px" /></span>
				</div>

			<?php
                
                if(!Client::isconnected()){ ?>
			<div class="connexion">
				<span style="margin-right: 100px;font-size: 20px;"><a href="login.php"><strong>Se Connecter</strong></a></span>
				<span style="font-size: 20px;"><a href="signup.php"><strong>S'inscrire</strong></a></span>
			</div>
          <?php  } else { ?>
            <div class="deconnexion" style="display: inline;float: right;margin-top: 10px;font-size: 20px;">
				<strong>Bonjour <em><?php echo $user->getusername(); ?></em></strong><br>
				<a href="logout.php"><button class="btn"><strong>Déconnexion</strong></button></a>
			</div>
        <?php } ?>
		</div>
		<hr>
		<div class="m">
				<span style="margin-left: 200px;"><a href="index.php">ACCUEIL</a></span>
				<span><a href="mode.php?mode=1">FEMME</a></span>
				<span><a href="mode.php?mode=2">HOMME</a></span>
				<span style="border-right:0px;"><a href="mode.php?mode=3">ENFANT</a></span>
		</div>
		<hr>
<?php
    if(Client::isconnected() && ($user instanceof Client)){
?>
<div style="text-align:right" class="headerc">
    <span style="font-size:15px;font-weight:bold;"><a href="mon_panier.php">Mon Panier</a></span>
    <span style="font-size:15px;font-weight:bold;margin-left:50px;"><a href="mes_commandes.php">Mes Commandes</a></span>
</div>
<?php
    } else if(Client::isconnected() && ($user instanceof Admin)){ 
?>
<div style="text-align:right" class="headerc">
    <span style="font-size:15px;font-weight:bold;"><a href="g_articles.php">Articles</a></span>
    <span style="font-size:15px;font-weight:bold;margin-left:50px;"><a href="g_clients.php">Clients</a></span>
</div>
<?php
    }
?>