import { loadTemplate } from "../../js/utils.js";

let template = await loadTemplate("./component/profile/template.html");

let Profile = {};

Profile.format = function (obj) {
  let html = template;
  html = html.replace("{{id_profil}}", obj.id_profil);
  html = html.replace("{{nom_profil}}", obj.nom);
  return html;
};

Profile.render = async function (selector, data) {
  let html = "<option value='all'>All</option>";
  for (let obj of data) {
    html += Profile.format(obj);
  }
  let where = document.querySelector(selector);
  where.innerHTML = html;
};

export { Profile };
