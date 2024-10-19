import { loadTemplate } from "../../js/utils.js";

let template = await loadTemplate("./component/promote/template.html");

let Promote = {};

Promote.format = function (obj) {
  let html = template;
  html = html.replaceAll("{{id_movies}}", obj.id_movies);
  html = html.replace("{{titre}}", obj.titre);
  html = html.replace("{{realisateur}}", obj.realisateur);
  html = html.replace("{{annee}}", obj.annee);
  html = html.replace("{{image}}", obj.url_image);
  html = html.replace("{{trailer}}", obj.url_trailer);
  return html;
};

Promote.render = async function (selector, data) {
  let html = "";
  for (let obj of data) {
    html += Promote.format(obj);
  }
  let where = document.querySelector(selector);
  where.innerHTML = html;
};

export { Promote };
