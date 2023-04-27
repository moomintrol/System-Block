document.addEventListener("DOMContentLoaded", () => {
  let user = document.querySelector(".user");
  let modalWrapper = document.querySelector(".modal-wrapper");
  let modalClose = document.querySelector(".modal__close");
  let modal = document.querySelector(".modal");
  let sign = document.querySelector(".sign");
  let reg = document.querySelector(".reg");
  let btnBasketNoIin = document.querySelector(".btn-basket-no-in");
  let btnFindNoIn = document.querySelector(".btn-find-no-in");
  let btnReviewNoIn = document.querySelector(".btn-review-no-in");

  function openModal(button){
    if (button != null) {
      button.addEventListener("click", (e) => {
        e.preventDefault();
        modalWrapper.style.display = "block";
        modal.style.display = "block";
      });
    }
  }

  openModal(user);
  openModal(btnBasketNoIin);
  openModal(btnFindNoIn);
  openModal(btnReviewNoIn);

  let closeModal = () => (modalWrapper.style.display = "none");

  document.addEventListener("keyup", (e) => {
    if (e.key == "Escape") {
      closeModal();
    }
  });

  //закрытие окна на крестик
  modalClose.onclick = function () {
    closeModal();
  };

  reg.addEventListener("click", () => {
    document.querySelector(
      ".modal__content"
    ).innerHTML = `<form class="entrance" action="" method="POST" id="form-reg">
      <input type="hidden" name="action" value="reg">
      <input class="entrance-input" type="text" placeholder="фамилия" name="surname">
      <input class="entrance-input" type="text" placeholder="имя" name="name">
      <input class="entrance-input" type="email" placeholder="email" name="email">
      <input class="entrance-input" type="phone" placeholder="телефон" name="phone">
      <input class="entrance-input" type="password" placeholder="пароль" name="password">
      <input class="entrance-input" type="password" name="password_confirmation" placeholder="подтвердите пароль">
      <p class="error-modal"></p>
      <div class="agreem">
      <input checked type="checkbox" name="agreement" id="agreement">
      <label for="agreement">Согласен на обработку персональных данных</label>
      </div>
      <button class="btn-reg btn-modal" name="btn-reg">
      <p>Зарегестрироваться</p>
      </button>
    </form>`;
    modal.classList.remove("modal-sign");
    modalWrapper.classList.remove("modalWrapper-sign");
    sign.classList.remove("btn-modal-sign");

    modal.classList.add("modal-reg");
    modalWrapper.classList.add("modalWrapper-reg");
    reg.classList.add("btn-modal-reg");

    document.querySelector("#agreement").addEventListener("change", (e) => {
      document.querySelector(".btn-reg").disabled = !e.target.checked;
    });

    document
      .querySelector(".btn-reg")
      .addEventListener("click", async (event) => {
        let form = document.querySelector("#form-reg");
        event.preventDefault();
        let fd = new FormData(form);
        let res = await postFormData("/app/tables/users/save.user.php", fd);
        if (res.error != null) {
          document.querySelector(".error-modal").style.display = "block";
          document.querySelector(".error-modal").textContent = res.error;
        } else {
          closeModal();
          window.location.reload();
        }
      });
  });

  sign.addEventListener("click", () => {
    document.querySelector(
      ".modal__content"
    ).innerHTML = `<form class="entrance" action="" method="POST" id="form-auth">
      <input type="hidden" name="action" value="auth">
      <input class="entrance-input" type="email" placeholder="email" name="login">
      <input class="entrance-input" type="password" placeholder="пароль" name="password">
      <p class="error-modal"></p>
      <button class="btn-auth btn-modal" name="btnAuth">
        <h3>Войти</h3>
      </button>
      <p class="help">Забыли логин / пароль?</p>
    </form>`;
    modal.classList.remove("modal-reg");
    modalWrapper.classList.remove("modalWrapper-reg");
    reg.classList.remove("btn-modal-reg");

    modal.classList.add("modal-sign");
    modalWrapper.classList.add("modalWrapper-sign");
    sign.classList.add("btn-modal-sign");
  });

  document
    .querySelector(".btn-auth")
    .addEventListener("click", async (event) => {
      let form = document.querySelector("#form-auth");
      event.preventDefault();
      let fd = new FormData(form);
      let res = await postFormData("/app/tables/users/save.user.php", fd);
      if (res.user == null) {
        document.querySelector(".error-modal").style.display = "block";
        document.querySelector(".error-modal").textContent = res.error;
      } else {
        closeModal();
        window.location.reload();
      }
    });
});
