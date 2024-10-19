import { loadTemplate } from "../../client/js/utils.js";

let template = await loadTemplate("../backoffice/rating/template.html");

let Rating = {};

Rating.format = function (obj) {
  let html = template;
  html = html.replace("{{id_movies}}", obj.id_movies);
  html = html.replace("{{titre}}", obj.titre);
  return html;
};

Rating.render = async function (selector, data) {
  if (data.length == 0) {
    let html =
      "<option>Pas de note à réinitialiser, remplissez la BDD</option>";
    for (let obj of data) {
      html += Rating.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
  } else {
    let html = "";
    for (let obj of data) {
      html += Rating.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
  }
};

export { Rating };
