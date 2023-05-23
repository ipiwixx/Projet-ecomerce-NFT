function init() {
  let btnVisa = document.querySelector("#visa");

  btnVisa.addEventListener("click", visa);
}

window.onload = init;

function visa() {
  let divVisa = document.querySelector("#divVisa");
  divVisa.classList.replace("d-none", "d-block");

  //divVisa.classList.remove("d-none");
  //divVisa.classList.add("d-block");
}

function aFacturation() {
  if (document.getElementById("checkFac").checked) {
    document.getElementById("divFac").style.display = "none";
  } else {
    document.getElementById("divFac").style.display = "";
  }
}
