
const images = document.querySelectorAll('.image-cliquable');
images.forEach(image => {
  image.addEventListener('click', () => {
    if (image.classList.contains('en-plein-ecran')) {
      image.classList.remove('en-plein-ecran');
      document.body.classList.remove('flou-fond');
    } else {
      image.classList.add('en-plein-ecran');
      document.body.classList.add('flou-fond');
    }
  });
});



document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    const imagesPE = document.querySelectorAll('.image-cliquable.en-plein-ecran');
    imagesPE.forEach(image => {
      image.classList.remove('en-plein-ecran');
      document.body.classList.remove('flou-fond');
    });
  }
});




