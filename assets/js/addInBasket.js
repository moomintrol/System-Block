document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", async (event) => {
    if (event.target.classList.contains("btn-find")) {
      let id = event.target.dataset.btnId;
      await postJSON("/app/tables/basket/save.basket.php", id, "add").then(
        function (value) {
          let count = document.querySelector(".count_all");
          count.textContent = value.totalCount;
        }
      );
    }
  });
});
