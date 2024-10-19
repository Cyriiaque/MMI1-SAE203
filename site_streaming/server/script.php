<?php


require("model.php");

if (isset($_REQUEST['action']) && $_REQUEST['action']=='addmovie'){
  $titre = $_REQUEST['titre'];
  $realisateur = $_REQUEST['realisateur'];
  $annee = $_REQUEST['annee'];
  $url_image = $_REQUEST['url_image'];
  $url_trailer = $_REQUEST['url_trailer'];
  $categorie = $_REQUEST['categorie'];
  $ok = updateMovie($titre, $realisateur, $annee, $url_image, $url_trailer, $categorie);
  if ($ok>0){
    echo "Le film: $titre est à jour";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='delmovie'){
  $titre = $_REQUEST['titre'];
  $ok = deleteMovie($titre);
  if ($ok>0){
    echo "Le film: $titre a été supprimé.";
  }
  else{
    echo "Le film: $titre n'a pas pu être supprimé. (il n'existe peut être pas dans la BDD).";
  }
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getmovies'  && isset($_REQUEST['idcategory']) && !empty($_REQUEST['idcategory'])){
  $id = $_REQUEST['idcategory'];
  $movies = getMovieByCategory($id);
  echo json_encode($movies);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getmovies'  && isset($_REQUEST['key']) && !empty($_REQUEST['key'])){
  $key = $_REQUEST['key'];
  $movies = getMovieWithKey($key);
  echo json_encode($movies);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getmovies' && isset($_REQUEST['idpromote']) && $_REQUEST['idpromote']=='1'){
  $id = $_REQUEST['idpromote'];
  $promote = getPromote($id);
  echo json_encode($promote);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getmovies' ){
    $movies = getMovies();
    echo json_encode($movies);
    exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getcategories' ){
  $category = getCategory();
  echo json_encode($category);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getprofiles' ){
  $profil = getProfile();
  echo json_encode($profil);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getpromotes' && isset($_REQUEST['idpromote']) && $_REQUEST['idpromote']=='1'){
  $id = $_REQUEST['idpromote'];
  $promote = getPromote($id);
  echo json_encode($promote);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getpromotes' && isset($_REQUEST['idpromote']) && $_REQUEST['idpromote']=='0'){
  $id = $_REQUEST['idpromote'];
  $promote = getPromote($id);
  echo json_encode($promote);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getmovierating' ){
  $rating = getMovieRating();
  echo json_encode($rating);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getmovie'  && isset($_REQUEST['idmovie']) && !empty($_REQUEST['idmovie'])){
  $id = $_REQUEST['idmovie'];
  $movies = getMovieById($id);
  echo json_encode($movies);
  exit();
}

if ( isset($_REQUEST['titre']) && !empty($_REQUEST['titre']) ){
  $titre = $_REQUEST['titre'];
  $completion = getMovieByName($titre);
  echo json_encode($completion);
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='addprofile'){
  $name = $_REQUEST['name'];
  $ok = addProfile($name);
  if ($ok>0){
    echo "Le profil: $name est à jour";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='deleteprofile' && isset($_REQUEST['idprofile']) && !empty($_REQUEST['idprofile'])){
  $id = $_REQUEST['idprofile'];
  $ok = deleteProfile($id);
  if ($ok>0){
    echo "Le profil: $id a été supprimé.";
  }
  else{
    echo "Le profil: $id n'a pas pu être supprimé. (il n'existe peut être pas dans la BDD).";
  }
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getplaylist' && isset($_REQUEST['idprofile']) && !empty($_REQUEST['idprofile'])){
  $playlist = getPlaylist($_REQUEST['idprofile']);
  echo json_encode($playlist);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='addtoplaylist'  && isset($_REQUEST['idmovie']) && !empty($_REQUEST['idmovie']) && isset($_REQUEST['idprofile']) && !empty($_REQUEST['idprofile'])){
  $idmovie = $_REQUEST['idmovie'];
  $idprofile = $_REQUEST['idprofile'];
  $playlist = addPlaylist($idmovie,$idprofile);
  echo json_encode($playlist);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='deltoplaylist'  && isset($_REQUEST['idmovie']) && !empty($_REQUEST['idmovie']) && isset($_REQUEST['idprofile']) && !empty($_REQUEST['idprofile'])){
  $idmovie = $_REQUEST['idmovie'];
  $idprofile = $_REQUEST['idprofile'];
  $playlist = deletePlaylist($idmovie,$idprofile);
  echo json_encode($playlist);
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='addpromote' && isset($_REQUEST['idmovie']) && !empty($_REQUEST['idmovie'])){
  $idmovie = $_REQUEST['idmovie'];
  $ok = addPromote($idmovie);
  if ($ok>0){
    echo "Le film a bien été mis en avant";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='deletepromote' && isset($_REQUEST['idmovie']) && !empty($_REQUEST['idmovie'])){
  $idmovie = $_REQUEST['idmovie'];
  $ok = deletePromote($idmovie);
  if ($ok>0){
    echo "Le film a bien été enlevé de la mise en avant.";
  }
  else{
    echo "Le film n'a pas pu être enlevé de la mise en avant. (il n'existe peut être pas dans la BDD).";
  }
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='deleterating' && isset($_REQUEST['idrating']) && !empty($_REQUEST['idrating'])){
  $idrating = $_REQUEST['idrating'];
  $ok = deleteRating($idrating);
  if ($ok>0){
    echo "La note du film a bien été réinitialisée.";
  }
  else{
    echo "La note du film n'a pas pu être réinitialisée. (il n'existe peut être pas dans la BDD).";
  }
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='addrating'  && isset($_REQUEST['idmovie']) && !empty($_REQUEST['idmovie']) && isset($_REQUEST['idprofile']) && !empty($_REQUEST['idprofile']) && isset($_REQUEST['rate']) && !empty($_REQUEST['rate'])){
  $idmovie = $_REQUEST['idmovie'];
  $idprofile = $_REQUEST['idprofile'];
  $note = $_REQUEST['rate'];
  $rating = addRating($idmovie,$idprofile,$note);
  echo json_encode($rating);
  exit();
}

if ( isset($_REQUEST['action']) && $_REQUEST['action']=='getrating'  && isset($_REQUEST['idmovie']) && !empty($_REQUEST['idmovie'])){
  $idmovie = $_REQUEST['idmovie'];
  $rating = getRating($idmovie);
  echo json_encode($rating);
  exit();
}

http_response_code(404);

?>