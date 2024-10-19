import { loadTemplate } from "../../client/js/utils.js";

let template = await loadTemplate("../backoffice/profil/template.html");

let Profile = {};

Profile.format = function (obj) {
  let html = template;
  html = html.replace("{{id_profil}}", obj.id_profil);
  html = html.replace("{{nom_profil}}", obj.nom);
  return html;
};

Profile.render = async function (selector, data) {
  if (data.length == 0) {
    let html = "<option>Pas de profil à supprimer, remplissez la BDD</option>";
    for (let obj of data) {
      html += Profile.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
  } else {
    let html = "";
    for (let obj of data) {
      html += Profile.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
  }
};

export { Profile };
