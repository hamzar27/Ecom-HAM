<?php foreach($articles as $article){ ?>
                  <tr>
                        <td><img src="images/articles_images/<?php echo $article->getimage(); ?>" width="150px" heghit="150px" /></td>
                        <td><strong><?php echo $article->gettitle(); ?></strong><br>
                            Couleur : <?php echo $article->getcouleur(); ?><br>Taille : <?php echo $article->gettaille(); ?><br>
                            Mode : <?php echo $article->getmode(); ?><br>Catégorie : <?php echo $article->getcategorie(); ?><br>
                            Prix : <?php echo $article->getprix(); ?> DHs
                        </td>
                        <?php if(Client::isconnected() && ($user instanceof Client)){ ?>
                        <td id="<?php echo $article->getid(); ?>">
                            <button class="btn btn-secondary" onClick="myfunct(<?php echo $article->getid(); ?>)">Ajouter dans mon panier</button>
                            
                        </td>
                       
                        <?php } ?>
                      <?php if(Client::isconnected() && ($user instanceof Admin)){ ?>
                        <td>
                            <a href="modifier_article.php?id=<?php echo $article->getid(); ?>&t=<?php echo $article->gettaille(); ?>&m=<?php echo $article->getmode(); ?>"><button class="btn btn-primary">Modifier cet article</button></a>
                            <a href="supprimer_article.php?id=<?php echo $article->getid(); ?>"><button class="btn btn-danger">Supprimer cet article</button></a>
                        </td>
                    <?php } ?>
                    </tr>
                  
               <?php } ?>