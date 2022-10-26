function myfunct(i){
            document.getElementById(i).innerHTML = '<form method="post" action="ajouter_au_panier.php?ida='+i+'>\
            <label for="qt'+i+'">Quantité :</label><input type="number" class="form form-control" id="qt'+i+'" name="qt" required="required" /><br>\
                <input type="submit" class="btn btn-success" name="sub" />\
                </form>';
        }