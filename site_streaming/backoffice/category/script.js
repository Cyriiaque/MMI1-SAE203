import { loadTemplate } from "../../client/js/utils.js";

let template = await loadTemplate("../backoffice/category/template.html");

let Category = {};

Category.format = function (obj) {
  let html = template;
  html = html.replace("{{id_categorie}}", obj.id_category);
  html = html.replace("{{nom_categorie}}", obj.nom);
  return html;
};

Category.render = async function (selector, data) {
  if (data.length == 0) {
    let html = "<option>Pas de catégorie définie, remplissez la BDD</option>";
    for (let obj of data) {
      html += Category.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
  } else {
    let html = "";
    for (let obj of data) {
      html += Category.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
  }
};

export { Category };
