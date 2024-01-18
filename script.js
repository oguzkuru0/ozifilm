const arrows = document.querySelectorAll(".arrow");
const movielists = document.querySelectorAll(".movie-list");

arrows.forEach((arrow, i) => {
  let clickConter = 0;
  const imageItem = movielists[i].querySelectorAll("img").length;
  arrow.addEventListener("click", function () {
    if (imageItem - (4 + clickConter) >= 0) {
      clickConter++;
      movielists[i].style.transform = `translateX(${
        movielists[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
    } else {
      movielists[i].style.transform = "translateX(0)";
      clickcounter = 0;
    }
  });
  console.log(window.innerWidth);
});

/*  dark mode start */

const ball = document.querySelector(".toggle-ball");
const items = document.querySelectorAll(
  ".container,.navbar,.sidebar,.sidebar i,.toggle,.toggle-ball,.movie-list-filter select,.movie-list-title"
);

ball.addEventListener("click", function () {
  items.forEach((item) => item.classList.toggle("active"));
});

/* dark mode end  */
