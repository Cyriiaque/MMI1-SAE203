import { loadTemplate } from "../../client/js/utils.js";

let template = await loadTemplate("../backoffice/promote/template.html");

let Promote = {};

Promote.format = function (obj) {
  let html = template;
  html = html.replace("{{id_movies}}", obj.id_movies);
  html = html.replace("{{titre}}", obj.titre);
  return html;
};

Promote.render = async function (selector, data) {
  if (data.length == 0) {
    let html = "<option>Pas de film, ajoutez-en</option>";
    for (let obj of data) {
      html += Promote.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
  } else {
    let html = "";
    for (let obj of data) {
      html += Promote.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
  }
};

export { Promote };
