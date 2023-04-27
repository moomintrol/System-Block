document.addEventListener("DOMContentLoaded", () => {
  let productsConteiner = document.querySelector(".orders-table");
  let orderElements = document.querySelectorAll("[name='status']");
  let orders = [];

  //загружаем все карточки с товарами
  getProducts("all");

  //при выборе категорий будем подгружать их товары
  orderElements.forEach((item) => {
    item.addEventListener("change", async () => {
      //коллекцию флажков преобразовали в массив, затем нашли только включенные и достали их значения
      let checkedOrders = [...orderElements]
        .filter((item) => item.checked)
        .map((item) => item.value);
      await getProducts(checkedOrders);
    });
  });

  //создаём функцию для загрузки данных
  async function getProducts(orders) {
    //формируем параметр
    const param = new URLSearchParams();
    param.append("status", JSON.stringify(orders));

    orders = await getData("/app/admin/tables/search.check.php", param);
    //выведим полученные данные на страницу
    outOnPage(orders);
  }

  function outOnPage(orders) {
    productsConteiner.innerHTML = ``;
    orders.forEach((item) => {
      productsConteiner.insertAdjacentHTML("beforeend", createCard(item));
    });
  }

  //создаём карточку товара
  function createCard({
    id,
    user,
    status,
    reason_cancel,
    created_at,
    updated_at,
  }) {
    return `<tr class="tr-order">
    <td>${id}</td>
    <td>${user}</td>
    <td id="status" data-order-status="${id}">${status}</td>
    <td id="reason_cancel" data-order-value="${id}">${reason_cancel}</td>
    <td>${created_at}</td>
    <td>${updated_at}</td>
    <td><?= Order::totalPrice(${id}) ?></td>
    <td><?= Order::totalCount(${id}) ?></td>
    <td>
        <form action="/app/admin/tables/show.order.products.php">
            <input hidden type="text" name="id" value="${id}">
            <button name="btn" class="btn btn-primary">Посмотреть</button>
        </form>
    </td>
    <td>
        <form class="updateStatus" action="/app/admin/tables/update.category.php" method="POST">
          <input hidden type="text" name="id" value="${id}">
          <button id="btnConfirm" name="btnUpdateStatus" data-order-confirm="${id}">Изменить статус</button>
        </form>
    </td>
    </tr>`;
  }
});
