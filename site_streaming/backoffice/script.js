let autoCompleteMovie = async function () {
  let titre = document.querySelector("#titre");

  let response = await fetch("../server/script.php?titre=" + titre.value);
  let data = await response.json();

  if (data.length > 0) {
    V.updateForm(data[0]);
  }
};

let V = {};

V.updateForm = function (movies) {
  let input_titre = document.querySelector('input[name="titre"]');
  let input_realisateur = document.querySelector('input[name="realisateur"]');
  let input_annee = document.querySelector('input[name="annee"]');
  let input_url_image = document.querySelector('input[name="url_image"]');
  let input_url_trailer = document.querySelector('input[name="url_trailer"]');
  let select_categories = document.querySelector('select[name="categorie"]');

  input_titre.value = movies.titre;
  input_realisateur.value = movies.realisateur;
  input_annee.value = movies.annee;
  input_url_image.value = movies.url_image;
  input_url_trailer.value = movies.url_trailer;
  select_categories.value = movies.id_category;
};

let requestCategory = async function () {
  let response = await fetch("../server/script.php?action=getcategories");
  let data = await response.json();
  Category.render(".selectcategory", data);
};

let requestProfile = async function () {
  let response = await fetch("../server/script.php?action=getprofiles");
  let data = await response.json();
  Profile.render(".selectprofile", data);
};

let requestPromoted = async function () {
  let response = await fetch(
    "../server/script.php?action=getpromotes&idpromote=0"
  );
  let data = await response.json();
  Promote.render(".selectnotpromoted", data);
};

let requestnotPromoted = async function () {
  let response = await fetch(
    "../server/script.php?action=getpromotes&idpromote=1"
  );
  let data = await response.json();
  Promote.render(".selectpromoted", data);
};

let requestMovieRating = async function () {
  let response = await fetch("../server/script.php?action=getmovierating");
  let data = await response.json();
  Rating.render(".selectrating", data);
};

let init = function () {
  requestCategory();
  requestProfile();
  requestPromoted();
  requestnotPromoted();
  requestMovieRating();
};
