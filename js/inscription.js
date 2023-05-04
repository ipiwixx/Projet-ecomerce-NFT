window.onload = (event) => {
    const eye = document.querySelector('.oldE');
    const eyeoff = document.querySelector('.oldEO');
    const passwordField = document.querySelector('.old[type="password"]');

    eye.addEventListener('click', () => {
        eye.style.display = "none";
        eyeoff.style.display = "block";
        passwordField.type = "text";
    });

    eyeoff.addEventListener("click", () => {
        eyeoff.style.display = "none";
        eye.style.display = "block";
        passwordField.type = "password";
      });

    const eye2 = document.querySelector('.newE');
    const eyeoff2 = document.querySelector('.newEO');
    const passwordField2 = document.querySelector('.new[type="password"]');

    eye2.addEventListener('click', () => {
        eye2.style.display = "none";
        eyeoff2.style.display = "block";
        passwordField2.type = "text";
    });

    eyeoff2.addEventListener("click", () => {
        eyeoff2.style.display = "none";
        eye2.style.display = "block";
        passwordField2.type = "password";
      });
};