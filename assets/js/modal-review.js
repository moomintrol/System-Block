document.addEventListener("DOMContentLoaded", () => {
  let modalWrapperReview = document.querySelector(".modal-wrapper-review");
  let modalClose = document.querySelector(".modal__close__review");
  let stars = document.querySelectorAll(".radio-star");
  let label = document.querySelectorAll(".review-label");
  let lineDivPercents = document.querySelectorAll(
    ".div-percent > .line-div-percent"
  );
  let pPercents = document.querySelectorAll(".p-percent");
  let btnRewiew = document.querySelectorAll(".btn-review-profile");
  let btnReviewIn = document.querySelector(".btn-review-in");

  if (btnRewiew != null) {
    btnRewiew.forEach((item) => {
      item.addEventListener("click", (e) => {
        modalWrapperReview.style.display = "block";
        document.querySelector(".form-review").insertAdjacentHTML(
          "beforeend",
          `
      <input hidden class="id" type="text" name="id" value="${e.currentTarget.value}">
      `
        );
      });
    });
  }

  if (btnReviewIn != null) {
    btnReviewIn.addEventListener("click", () => {
      modalWrapperReview.style.display = "block";
    });
  }

  let closeModal = () => (modalWrapperReview.style.display = "none");

  document.addEventListener("keyup", (e) => {
    if (e.key == "Escape") {
      closeModal();
    }
  });

  modalClose.onclick = function () {
    closeModal();
  };

  stars.forEach((item) => {
    item.addEventListener("click", () => {
      for (let i = 0; i < item.value; i++) {
        label[
          i
        ].innerHTML = `<img class="review-star" src="/upload/icons/star.svg" alt="star">`;
      }
      for (let i = 5; i > item.value; i--) {
        label[
          i - 1
        ].innerHTML = `<img class="review-star" src="/upload/icons/star-empty.svg" alt="star">`;
      }
    });
  });

  lineDivPercents.forEach((item, key) => {
    item.style.width = pPercents[key].textContent;
  });

  document
    .querySelector(".btn-form-review")
    .addEventListener("click", async (event) => {
      let form = document.querySelector(".form-review");
      event.preventDefault();
      let fd = new FormData(form);
      let res = await postFormData("/app/tables/review.php", fd);
      if (res.error != null) {
        document.querySelector(".error").style.display = "block";
        document.querySelector(".error").textContent = res.error;
      } else {
        closeModal();
        window.location.reload();
      }
    });

  // document
  //   .querySelector(".btn-review")
  //   .addEventListener("click", async (event) => {
  //     let form = document.querySelector(".form-review");
  //     event.preventDefault();
  //     let fd = new FormData(form);
  //     let res = await postFormData("/app/tables/review.php", fd);
  //     if (res.error != null) {
  //       document.querySelector(".error").style.display = "block";
  //       document.querySelector(".error").textContent = res.error;
  //     } else {
  //       closeModal();
  //       window.location.reload();
  //     }
  //   });
});
