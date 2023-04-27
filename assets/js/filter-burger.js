document.addEventListener("DOMContentLoaded", () => {
  document
    .querySelector(".filter-burger")
    .addEventListener("click", function () {
      document.querySelector(".filter").classList.toggle("filter-burger-open");
      // document.querySelector(".img-filter").src = "/upload/icons/close.svg";
    });
  document
    .querySelector(".btn-search-product")
    .addEventListener("click", () => {
      document.querySelector(".filter").classList.remove("filter-burger-open");
    });

  document.querySelector(".filter-close").addEventListener("click", () => {
    document.querySelector(".filter").classList.remove("filter-burger-open");
  });
});
