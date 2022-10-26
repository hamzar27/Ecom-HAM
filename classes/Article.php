<?php

class Article{
    private $id;
    private $title;
    private $image;
    private $prix;
    private $categorie;
    private $couleur;
    private $taille;
    private $mode;
    
    public function Article($title,$image,$prix,$couleur,$taille,$mode){
        $this->title = $title;
        $this->image = $image;
        $this->prix = $prix;
        $this->couleur = $couleur;
        $this->taille = $taille;
        $this->mode = $mode;
    }
    //Setters
    public function setid($id){
        $this->id = $id;
    }
    public function setcategorie($cat){
        $this->categorie = $cat;
    }
    //Getters
    public function getid(){
        return $this->id;
    }
    public function gettitle(){
        return $this->title;
    }
    public function getimage(){
        return $this->image;
    }
    public function getprix(){
        return $this->prix;
    }
    public function getcouleur(){
        return $this->couleur;
    }
    public function gettaille(){
        return $this->taille;
    }
    public function getmode(){
        return $this->mode;
    }
    public function getidcategorie(){
        include('connexion/connect.php');
        $cat = $conn->query("select * from articles where id = $this->id")->fetch();
        $conn = null;
        return $cat['id_categorie'];
    }
    public function getcategorie(){
        include('connexion/connect.php');
        $cat = $conn->query("select * from categories where id = (select id_categorie from articles where id = $this->id)")->fetch();
        $conn = null;
        return $cat['nom'];
    }
    
    public function ajouter_article(){
        include('connexion/connect.php');
        $req = $conn->prepare("insert into articles(title,img,prix,id_categorie,couleur,taille,mode) values(:title,:image,:prix,:id_categorie,:couleur,:taille,:mode)");
        
        $req->execute(array(
            "title" => $this->title,
            "image" => $this->image,
            "prix" => $this->prix,
            "id_categorie" => $this->categorie,
            "couleur" => $this->couleur,
            "taille" => $this->taille,
            "mode" => $this->mode,
        ));
        $conn = null;
    }
    
    public static function articleHomme(){
        include('connexion/connect.php');
        $i = 0;
        $articles = array();
        $result = $conn->query("select * from articles where mode = \"homme\" order by rand() limit 70");
        while($article = $result->fetch()){
            $articles[$i] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
             $articles[$i]->setid($article['id']);
            $i = $i + 1;
        }
        $conn = null;
        return $articles;
    }
    public static function articleFemme(){
        include('connexion/connect.php');
        $i = 0;
        $articles = array();
        $result = $conn->query("select * from articles where mode = \"femme\" order by rand() limit 70");
        while($article = $result->fetch()){
            $articles[$i] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
             $articles[$i]->setid($article['id']);
            $i = $i + 1;
        }
        $conn = null;
        return $articles;
    }
    public static function articleEnfant(){
        include('connexion/connect.php');
        $i = 0;
        $articles = array();
        $result = $conn->query("select * from articles where mode = \"enfant\" order by rand() limit 70");
        while($article = $result->fetch()){
             $articles[$i] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
             $articles[$i]->setid($article['id']);
            $i = $i + 1;
        }
        $conn = null;
        return $articles;
    }
    
    public static function getcategories(){
        include('connexion/connect.php');
        $i = 0;
        $categories = array();
        $result = $conn->query("select * from categories");
         while($cat = $result->fetch()){
            $categories[$i] = new Categorie($cat['id'],$cat['nom']);
             $i = $i + 1;
         }
        $conn = null;
        return $categories;
    }
    
    public static function getcolors(){
        include('connexion/connect.php');
        $i = 0;
        $colors = array();
        $result = $conn->query("select distinct couleur from articles");
        while($col = $result->fetch()){
            $colors[$i] = $col['couleur'];
            $i = $i + 1;
        }
        $conn = null;
        return $colors;
    }
    public static function setmode($i){
        if($i==1) return "homme";
        if($i==2) return "femme";
        return "enfant";
    }
    
    public static function settaille($i){
        if($i==1) return "S";
        if($i==2) return "M";
        return "L";
    }
    public static function getrandomarticles(){
        include('connexion/connect.php');
        $articles = array();
        $i = 0;
        $result = $conn->query("select * from articles order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$i] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$i]->setid($article['id']);
            $i = $i + 1;
        }
        $conn = null;
        return $articles;
        
    }
    public static function getarticlebyid($id){
        include('connexion/connect.php');
        $art = $conn->query("select * from articles where id = $id")->fetch();
        $article = new Article($art['title'],$art['img'],$art['prix'],$art['couleur'],$art['taille'],$art['mode']);
        $article->setid($id);
        return $article;
    }
    public static function supprimer_articlebyid($id){
        include('connexion/connect.php');
        $req = $conn->prepare("delete from articles where id = :ida");
        $req->execute(array(
            "ida" => $id
        ));
        $conn = null;
    }
    public function supprimer_article(){
        include('connexion/connect.php');
        $req = $conn->prepare("delete from articles where id = :ida");
        $req->execute(array(
            "ida" => $this->id,
        ));
        $conn = null;
    }
    public static function nbr_article(){
        include('connexion/connect.php');
        $i = 0;
        $result = $conn->query("select * from articles");
        while($article = $result->fetch()) $i++;
        $conn = null;
        return $i;
    }
    //Menu Methods
    public static function articles_by_mode($i){
        $articles = array();
        $j = 0;
        if($i==1) $mode = "homme";
        else if($i==2) $mode = "femme";
        else if($i==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where mode = \"$mode\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
            
    }
    public static function articles_by_prix($i){
        $articles = array();
        $j = 0;
        if($i==1){
            $min = 20;
            $max = 100;
        }
        else if($i==2){
            $min = 100;
            $max = 200;
        }
        else if($i==3){
            $min = 200;
            $max = 300;
        }
       else if($i==4){
            $min = 300;
            $max = 400;
        }
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
            
    }
    
    public static function articles_by_prix_mode($p,$m){
        $articles = array();
        $j = 0;
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where prix BETWEEN $min AND $max AND mode = \"$mode\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;    
    }
    public static function articles_by_taille($t){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
         include('connexion/connect.php');
        $result = $conn->query("select * from articles where taille = \"$taille\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles; 
            
    }
    
    public static function articles_by_taille_mode($t,$m){
        $articles = array();
        $j = 0;
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where taille = \"$taille\" AND mode = \"$mode\" order by rand() limit 30");
         while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
        
    }
    
    public static function articles_by_prix_taile($p,$t){
        $articles = array();
        $j = 0;
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where taille = \"$taille\" AND prix BETWEEN $min AND $max order by rand() limit 30");
         while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
        
    }
    public static function articles_by_taille_prix_mode($t,$p,$m){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where taille = \"$taille\" AND mode = \"$mode\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_color($couleur){
        $articles = array();
        $j = 0;
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where couleur = \"$couleur\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
        
    }
    public static function articles_by_color_mode($couleur,$m){
        $articles = array();
        $j = 0;
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where couleur = \"$couleur\" AND mode = \"$mode\" order by rand() limit 30");
         while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    
    public static function articles_by_color_prix($couleur,$p){
        $articles = array();
        $j = 0;
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where couleur = \"$couleur\" AND prix BETWEEN $min AND $max order by rand() limit 30");
         while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_mode_prix_couleur($m,$p,$couleur){
        $articles = array();
        $j = 0;
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where couleur = \"$couleur\" AND mode = \"$mode\" AND prix BETWEEN $min AND $max order by rand() limit 30");
         while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_couleur_taille($couleur,$t){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where couleur = \"$couleur\" AND taille = \"$taille\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_couleur_taille_mode($couleur,$t,$m){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where couleur = \"$couleur\" AND taille = \"$taille\" AND mode = \"$mode\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
        
    }
    public static function articles_by_couleur_taille_prix($couleur,$t,$p){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where couleur = \"$couleur\" AND taille = \"$taille\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;   
    }
    public static function articles_by_couleur_taille_prix_mode($couleur,$t,$p,$m){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where couleur = \"$couleur\" AND taille = \"$taille\" AND mode = \"$mode\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie($c){
        $articles = array();
        $j = 0;
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles; 
    }
    public static function articles_by_categorie_mode($c,$m){
        $articles = array();
        $j = 0;
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND mode = \"$mode\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie_prix($c,$p){
        $articles = array();
        $j = 0;
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie_prix_mode($c,$p,$m){
        $articles = array();
        $j = 0;
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND mode = \"$mode\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie_taille($c,$t){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND taille=\"$taille\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;     
    }
    public static function articles_by_categorie_taille_mode($c,$t,$m){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND taille=\"$taille\" AND mode = \"$mode\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
            
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie_taille_prix($c,$t,$p){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND taille=\"$taille\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles; 
    }
    public static function articles_by_categorie_taille_prix_mode($c,$t,$p,$m){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND taille=\"$taille\" AND mode = \"$mode\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles;    
    }
    public static function articles_by_categorie_couleur($c,$couleur){
        $articles = array();
        $j = 0;
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND couleur = \"$couleur\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles; 
    }
    public static function articles_by_categorie_couleur_mode($c,$couleur,$m){
        $articles = array();
        $j = 0;
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND couleur = \"$couleur\" AND mode = \"$mode\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie_couleur_prix($c,$couleur,$p){
        $articles = array();
        $j = 0;
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND couleur = \"$couleur\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie_couleur_prix_mode($c,$couleur,$p,$m){
        $articles = array();
        $j = 0;
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND couleur = \"$couleur\" AND mode = \"$mode\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie_couleur_taille($c,$couleur,$t){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND couleur = \"$couleur\" AND taille = \"$taille\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles;  
    }
    public static function articles_by_categorie_couleur_taille_mode($c,$couleur,$t,$m){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND couleur = \"$couleur\" AND taille = \"$taille\" AND mode = \"$mode\" order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles;   
    }
    public static function articles_by_categorie_couleur_taille_prix($c,$couleur,$t,$p){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND couleur = \"$couleur\" AND taille = \"$taille\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles;
    }
    public static function articles_by_categorie_couleur_taille_prix_mode($c,$couleur,$t,$p,$m){
        $articles = array();
        $j = 0;
        if($t==1) $taille = "S";
        else if($t==2) $taille = "M";
        else if($t==3) $taille = "L";
        if($p==1){
            $min = 20;
            $max = 100;
        }
        else if($p==2){
            $min = 100;
            $max = 200;
        }
        else if($p==3){
            $min = 200;
            $max = 300;
        }
       else if($p==4){
            $min = 300;
            $max = 400;
        }
        if($m==1) $mode = "homme";
        else if($m==2) $mode = "femme";
        else if($m==3) $mode = "enfant";
        include('connexion/connect.php');
        $result = $conn->query("select * from articles where id_categorie = $c AND couleur = \"$couleur\" AND taille = \"$taille\" AND mode = \"$mode\" AND prix BETWEEN $min AND $max order by rand() limit 30");
        while($article = $result->fetch()){
            $articles[$j] = new Article($article['title'],$article['img'],$article['prix'],$article['couleur'],$article['taille'],$article['mode']);
            $articles[$j]->setid($article['id']);
            $j = $j + 1;
        }
        $conn = null;
        return $articles;
    }
    
    
    
}




?>