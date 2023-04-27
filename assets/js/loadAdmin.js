async function outOnBasketPage(productId, action) {
  await postJSON("/app/admin/tables/save.admin.php", productId, action);
}

document.addEventListener("click", async (event) => {
  if (event.target.classList.contains("delete-category")) {
    outOnBasketPage(event.target.dataset.productId, "deleteCategory");
    event.target.closest(".category").remove();
  }
  if (event.target.classList.contains("delete-product")) {
    outOnBasketPage(event.target.dataset.productId, "deleteProduct");
    event.target.closest(".tr-product").remove();
  }
  if (event.target.classList.contains("delete-admin")) {
    outOnBasketPage(event.target.dataset.productId, "deleteAdmin");
    event.target.closest(".tr-admin").remove();
  }
  if (event.target.classList.contains("delete-characteristic")) {
    outOnBasketPage(event.target.dataset.productId, "deleteCharacteristic");
    event.target.closest(".tr-characteristic").remove();
  }
  if (event.target.classList.contains("delete-component")) {
    outOnBasketPage(event.target.dataset.productId, "deleteComponent");
    event.target.closest(".tr-component").remove();
  }
});
