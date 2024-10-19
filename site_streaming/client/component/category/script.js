import { loadTemplate } from "../../js/utils.js";

let template = await loadTemplate("./component/category/template.html");

let Category = {};

Category.format = function (obj) {
  let html = template;
  html = html.replace("{{id_categorie}}", obj.id_category);
  html = html.replace("{{nom_categorie}}", obj.nom);
  return html;
};

Category.render = async function (selector, data) {
  let html = "<option value='all'>All</option>";
  for (let obj of data) {
    html += Category.format(obj);
  }
  let where = document.querySelector(selector);
  where.innerHTML = html;
};

export { Category };
