let count = document.querySelector(".count_all");

async function outOnBasketPage(productId, action) {
  let { productInBasket, totalPrice, totalCount } = await postJSON(
    "/app/tables/basket/save.basket.php",
    productId,
    action
  );

  count.textContent = totalCount ?? 0;

  if (productInBasket) {
    document.querySelector(`#count-${productId}`).textContent =
      productInBasket.count ?? 0;

    document.querySelector(
      `[data-price-position="${productId}"]`
    ).innerHTML = `${Math.round(productInBasket.price_position) ?? 0}₽`;

    if (document.querySelector(`#count-${productId}`).textContent > 1) {
      document.querySelector(`#price-${productId}`).style.display = "block";
    } else {
      document.querySelector(`#price-${productId}`).style.display = "none";
    }
  }

  document.querySelector(".totalPrice").textContent = `${
    Math.round(totalPrice) ?? 0
  }₽`;
  document.querySelector(".totalCount").textContent = `${totalCount ?? 0}`;

  if ((count.textContent = 0)) {
    checkForEmp();
  }
}

document.addEventListener("click", async (event) => {
  if (event.target.classList.contains("plus")) {
    outOnBasketPage(event.target.dataset.productId, "add");
    checkForEmp();
  }
  if (event.target.classList.contains("minus")) {
    outOnBasketPage(event.target.dataset.productId, "minus");
    checkForEmp();
  }
  if (event.target.classList.contains("delete")) {
    outOnBasketPage(event.target.dataset.productId, "delete");
    event.target.closest(".basket-position").remove();
    checkForEmp();
  }

  if (event.target.classList.contains("clear")) {
    outOnBasketPage(event.target.dataset.productId, "clear");
    document
      .querySelectorAll(".basket-position")
      .forEach((item) => item.remove());
    document.querySelector(".totalCount").textContent = 0;
    checkForEmp();
  }
});

function checkForEmp() {
  if (count == 0 || document.querySelector(".basket-position") == null) {
    document.querySelector(".totalPrice").style.display = "none";
    document.querySelector(".totalCount").style.display = "none";
    document.querySelector(".basket").style.display = "none";
    document.querySelector(".basket-empty").style.display = "grid";
    document.querySelector(".message").textContent = "Ваша корзина пустая";
  }

  document.querySelectorAll(".basket-position").forEach((item) => {
    if (
      document.querySelector(`#count-${item.dataset.productId}`).textContent > 1
    ) {
      document.querySelector(`#price-${item.dataset.productId}`).style.display =
        "block";
    } else {
      document.querySelector(`#price-${item.dataset.productId}`).style.display =
        "none";
    }
  });
}

checkForEmp();
