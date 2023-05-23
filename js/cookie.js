function init() {
  let btnShow = document.querySelector("#showC");
  let btnHide = document.querySelector("#hideC");
  let btnBvn = document.querySelector("#hideB");

  btnShow.addEventListener("click", showCookie);
  btnHide.addEventListener("click", hideCookie);
  btnBvn.addEventListener("click", hideBienvenue);
}

window.onload = init;

function showCookie() {
  let divCookie = document.querySelector("#divC");
  divCookie.classList.replace("d-none", "d-block");
}

function hideCookie() {
  let divCookie = document.querySelector("#divC");
  divCookie.classList.replace("d-block", "d-none");
}

function hideBienvenue() {
  let divBvn = document.querySelector("#divB");
  divBvn.classList.replace("d-block", "d-none");
}
