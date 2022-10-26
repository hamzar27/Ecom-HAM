<div style="display:inline;float:left;border: 1px solid gray;padding:30px;text-align:center;margin-left:30px;" class="form form-group">
                  <form method="post" action="mode.php?mode=4">
                    <label>Catégorie :</label>
                    <select name="categorie" class="form form-control">
                        <option value="0">All</option>
                        <?php $result = $conn->query("select * from categories"); ?>
                        <?php while($cat = $result->fetch()) { ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nom']; ?></option>
                        <?php } ?>
                    </select><br>
                    <label>Couleur :</label>
                      <select name="couleur" class="form form-control">
                        <option value="all">All</option>
                      <?php $result = $conn->query("select distinct couleur from articles"); ?>
                      <?php while($couleur = $result->fetch()){ ?>
                        <option><?php echo $couleur['couleur']; ?></option>  
                      <?php } ?>
                    </select><br>
                      <label>Taille :</label>
                      <select name="taille" class="form form-control">
                        <option value="0">All</option>
                        <option value="1">Small</option>
                        <option value="2">Medium</option>
                        <option value="3">Large</option>
                      </select><br>
                      <div class="form">
                        <label>Prix : (en DHs)</label><br>
                          
                        <input type="radio" name="prix" id="0" value="0" checked="checked" hidden/><label for="0"></label><br>
                          <input type="radio" name="prix" id="1" value="1" /><label for="1">20 - 100</label><br>
                          <input type="radio" name="prix" id="2" value="2" /><label for="2">100 - 200</label><br>
                          <input type="radio" name="prix" id="3" value="3" /><label for="3">200 - 300</label><br>
                          <input type="radio" name="prix" id="4" value="4" /><label for="4">300 - 400</label><br>
                      </div><br>
                      <label>Mode :</label>
                      <select name="mode" class="form form-control">
                        <option value="0">All</option>
                        <option value="1">Homme</option>
                        <option value="2">Femme</option>
                        <option value="3">Enfant</option>
                      
                      </select><br>
                      <input type="submit" name="sub" class="form form-control btn btn-primary"/>
                  </form>
              
</div>