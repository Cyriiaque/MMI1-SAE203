let requestMovieMore = async function (id) {
  let response = await fetch(
    "../server/script.php?action=getmovie&idmovie=" + id
  );
  requestRating(id);
  let data = await response.json();
  Moviemore.render(".movies", data);
};

let requestCategory = async function () {
  let response = await fetch("../server/script.php?action=getcategories");
  let data = await response.json();
  Category.render(".selectcategory", data);
};

let requestMovie = async function () {
  let idcategorieselect = document.querySelector("#categorie");
  if (idcategorieselect.value == "all") {
    let response = await fetch("../server/script.php?action=getmovies");
    let data = await response.json();
    Movies.render(".movies", data);
  } else {
    let response = await fetch(
      "../server/script.php?action=getmovies&idcategory=" +
        idcategorieselect.value
    );
    let data = await response.json();
    Movies.render(".movies", data);
  }
};

let requestProfile = async function () {
  let response = await fetch("../server/script.php?action=getprofiles");
  let data = await response.json();
  Profile.render(".selectprofile", data);
};

let requestPlaylist = async function () {
  let idprofileselect = document.querySelector("#profile");
  if (idprofileselect.value == "all") {
    let response = await fetch("../server/script.php?action=getmovies");
    let data = await response.json();
    Movies.render(".movies", data);
  } else {
    let response = await fetch(
      "../server/script.php?action=getplaylist&idprofile=" +
        idprofileselect.value
    );
    let data = await response.json();
    Playlist.render(".movies", data);
  }
};

let requestaddPlaylist = async function (idmovie) {
  let idprofileselect = document.querySelector("#profile");
  await fetch(
    "../server/script.php?action=addtoplaylist&idprofile=" +
      idprofileselect.value +
      "&idmovie=" +
      idmovie
  );
};

let requestdelPlaylist = async function (idmovie) {
  let idprofileselect = document.querySelector("#profile");
  await fetch(
    "../server/script.php?action=deltoplaylist&idprofile=" +
      idprofileselect.value +
      "&idmovie=" +
      idmovie
  );
};

let requestPromote = async function () {
  let response = await fetch(
    "../server/script.php?action=getmovies&idpromote=1"
  );
  let data = await response.json();
  Promote.render(".promotes", data);
};

let searchMovie = async function () {
  let key = document.querySelector("#searchbar").value;
  let response = await fetch(
    "../server/script.php?action=getmovies&key=" + key
  );
  let data = await response.json();
  Movies.render(".movies", data);
};

let requestaddRating = async function (note, idmovie) {
  let idprofileselect = document.querySelector("#profile");
  await fetch(
    "../server/script.php?action=addrating&idprofile=" +
      idprofileselect.value +
      "&idmovie=" +
      idmovie +
      "&rate=" +
      note
  );
};

let requestRating = async function (idmovie) {
  let response = await fetch(
    "../server/script.php?action=getrating&idmovie=" + idmovie
  );
  let data = await response.json();
  let dividende = 0;
  for (let i = 0; i < data.length; i++) {
    dividende += data[i].note;
  }
  diviseur = data.length;
  moyenne = Math.round(dividende / diviseur);
  AverageRating(moyenne);
};

let init = function () {
  requestMovie();
  requestCategory();
  requestProfile();
  requestPromote();
};

let deletePlaylist = async function (idmovies) {
  await requestdelPlaylist(idmovies);
  requestPlaylist();
};

///////////// Système de notes ////////////

function onStarClick(note, idmovie) {
  let etoiles = document.querySelectorAll(".star");

  for (let i = 0; i < note; i++) {
    let etoile = etoiles[i];
    etoile.classList.add("staractive");
    etoile.classList.remove("starinactive");
  }
  for (let i = note; i < 5; i++) {
    let etoile = etoiles[i];
    etoile.classList.add("starinactive");
    etoile.classList.remove("staractive");
  }
  requestaddRating(note, idmovie);
}

function AverageRating(note) {
  let etoiles = document.querySelectorAll(".staraverage");

  for (let i = 0; i < note; i++) {
    let etoile = etoiles[i];
    etoile.classList.add("staractive");
    etoile.classList.remove("starinactive");
  }
  for (let i = note; i < 5; i++) {
    let etoile = etoiles[i];
    etoile.classList.add("starinactive");
    etoile.classList.remove("staractive");
  }
}
