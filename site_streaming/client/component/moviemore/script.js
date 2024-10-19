import { loadTemplate } from "../../js/utils.js";

let template = await loadTemplate("./component/moviemore/template.html");

let Moviemore = {};

Moviemore.format = function (obj) {
  let html = template;
  html = html.replaceAll("{{id_movies}}", obj.id_movies);
  html = html.replace("{{titre}}", obj.titre);
  html = html.replace("{{realisateur}}", obj.realisateur);
  html = html.replace("{{annee}}", obj.annee);
  html = html.replace("{{trailer}}", obj.url_trailer);
  return html;
};

Moviemore.render = async function (selector, data) {
  let html = "";
  for (let obj of data) {
    html += Moviemore.format(obj);
  }
  let where = document.querySelector(selector);
  where.innerHTML = html;
};

export { Moviemore };
