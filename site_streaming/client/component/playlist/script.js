import { loadTemplate } from "../../js/utils.js";

let template = await loadTemplate("./component/playlist/template.html");

let Playlist = {};

Playlist.format = function (obj) {
  let html = template;
  html = html.replace("{{titre}}", obj.titre);
  html = html.replace("{{realisateur}}", obj.realisateur);
  html = html.replace("{{annee}}", obj.annee);
  html = html.replaceAll("{{id_movies}}", obj.id_movies);
  html = html.replace("{{image}}", obj.url_image);
  return html;
};

Playlist.render = async function (selector, data) {
  let html = "";
  for (let obj of data) {
    html += Playlist.format(obj);
  }
  let where = document.querySelector(selector);
  where.innerHTML = html;
};

export { Playlist };
