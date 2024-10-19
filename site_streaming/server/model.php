<?php

function getMovies(){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Movies"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getCategory(){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Category"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getProfile(){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from UserProfile"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getPromote($id){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Movies where id_promote='$id'");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getMovieRating(){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Rating inner join Movies on Rating.id_movies = Movies.id_movies"); 
    // j'aurais dû faire:
    //select distinct titre from Rating inner join Movies on Rating.id_movies = Movies.id_movies
    //pour ne récupérer qu'une fois chaque titre mais je n'ai pas le temps d'essayer de faire correspondre la suppression
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getMovieByName($titre){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Movies where titre='$titre'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getMovieById($id){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Movies where id_movies='$id'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getMovieByCategory($id){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Movies where id_category='$id'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function updateMovie($t, $r, $a, $i, $u, $c){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("replace into Movies set titre='$t', realisateur='$r', annee='$a', url_image='$i', url_trailer='$u', id_category='$c'"); 
    $res = $answer->rowCount();
    return $res;
}

function deleteMovie($t){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("delete from Movies where titre='$t'"); 
    $res = $answer->rowCount();
    return $res;
}

function addProfile($nom){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("replace into UserProfile set nom='$nom'"); 
    $res = $answer->rowCount();
    return $res;
}

function deleteProfile($id){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("delete from UserProfile where id_profil='$id'"); 
    $res = $answer->rowCount();
    return $res;
}

function getPlaylist($idprofil){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Playlist inner join Movies on Playlist.id_movies = Movies.id_movies where id_profil='$idprofil'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function addPlaylist($idmovie,$idprofil){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("replace into Playlist set id_movies='$idmovie', id_profil='$idprofil'"); 
    $res = $answer->rowCount();
    return $res;
}

function deletePlaylist($idmovie, $idprofil){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("delete from Playlist where id_movies = $idmovie and id_profil = $idprofil"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function addPromote($id){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("update Movies set id_promote=1 where id_movies='$id'"); 
    $res = $answer->rowCount();
    return $res;
}

function deletePromote($id){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("update Movies set id_promote=0 where id_movies='$id'");
    $res = $answer->rowCount();
    return $res;
}

function getMovieWithKey($key){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select * from Movies where titre like '%$key%'");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function deleteRating($idmovie){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("delete from Rating where id_movies = $idmovie");
    $res = $answer->rowCount();
    return $res;
}

function addRating($idmovie,$idprofil,$rate){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("replace Rating set id_profil = $idprofil , id_movies = $idmovie , note=$rate");
    $res = $answer->rowCount();
    return $res;
}

function getRating($id){
    $cnx = new PDO("mysql:host=localhost;dbname=lemesle8", "lemesle8", "lemesle8");
    $answer = $cnx->query("select note from Rating where id_movies='$id'");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}