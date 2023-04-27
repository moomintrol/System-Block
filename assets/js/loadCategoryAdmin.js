document.addEventListener("DOMContentLoaded", () => {
    let productsConteiner = document.querySelector(".products-table");
    let categoryElements = document.querySelectorAll("[name='btn-category']");
    let products = [];
  
    //при выборе категорий будем подгружать их товары
    categoryElements.forEach((item) => {
      item.addEventListener("click", async (event) => {
        await getProducts(event.currentTarget.dataset.categoryId);
      });
    });
  
    //создаём функцию для загрузки данных
    async function getProducts(categories) {
      //формируем параметр
      const param = new URLSearchParams();
      param.append("category", categories);
      products = await getData("/app/tables/products/search.check.php", param);
      //выведим полученные данные на страницу
      outOnPage(products);
    }
  
    function outOnPage(products) {
      productsConteiner.innerHTML = ``;
      products.forEach((item) => {
        productsConteiner.insertAdjacentHTML("beforeend", createCard(item));
      });
    }
  
    //создаём карточку товара
    function createCard({
      id,
      name,
      image,
      price,
      overall_rating,
      count_reviews,
    }) {
      return `<tr class="tr-product">
      <td><img class="image-admin-product" src="/upload/System-Block/${image}" alt="${image}"></td>
      <td>${name}</td>
      <td>${price}</td>
      <td>${image}</td>
      <td>${overall_rating}</td>
      <td>${count_reviews}</td>
      <td><img class="btn-delete delete-product" src="/upload/icons/trash.svg" alt="trash" data-product-id="${id}"></td>
      <td><form action="/app/admin/tables/show.php" method="POST">
        <input hidden type="text" name="id" value="${id}">
        <button class="btn-edit-admin" name="btn-show">Редактировать</button>
      </form></td>
      </tr>`;
    }
  });
  