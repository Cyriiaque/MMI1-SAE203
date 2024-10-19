import { loadTemplate } from "../../js/utils.js";

let template = await loadTemplate("./component/movies/template.html");

let Movies = {};

Movies.format = function (obj) {
  let html = template;
  html = html.replaceAll("{{id_movies}}", obj.id_movies);
  html = html.replace("{{titre}}", obj.titre);
  html = html.replace("{{realisateur}}", obj.realisateur);
  html = html.replace("{{annee}}", obj.annee);
  html = html.replace("{{image}}", obj.url_image);
  html = html.replace("{{trailer}}", obj.url_trailer);
  return html;
};

Movies.render = async function (selector, data) {
  let html = "";
  for (let obj of data) {
    html += Movies.format(obj);
  }
  let where = document.querySelector(selector);
  where.innerHTML = html;
};

export { Movies };
