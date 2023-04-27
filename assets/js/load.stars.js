// document.addEventListener("DOMContentLoaded", () => {
//   let pOverallRating = document.querySelectorAll(".p-overall_rating");
//   let productsStars = document.querySelectorAll(".product-stars");
//   console.log(productsStars);
//   pOverallRating.forEach((item) => {
//     for (let i = 0; i < Math.floor(item.textContent); i++) {
//       productsStars[
//         i
//       ].innerHTML = ` <img class="review-overall-star" src="/upload/icons/star.svg" alt="star">`;
//     }
//     for (
//       let i = Math.floor(item.textContent);
//       i < Math.round(item.textContent);
//       i++
//     ) {
//       if (item.textContent - Math.floor(item.textContent) > 0.8) {
//         productsStars[
//           i
//         ].innerHTML = ` <img class="review-overall-star" src="/upload/icons/star.svg" alt="star">`;
//       } else {
//         productsStars[
//           i
//         ].innerHTML = `<img class="review-overall-star" src="/upload/icons/star-half.svg" alt="star"></img>`;
//       }
//     }
//   });
// });
