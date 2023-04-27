document.addEventListener("DOMContentLoaded", () => {
  let productsConteiner = document.querySelector(".products");
  let pages = document.querySelector(".pages");
  let categoryElements = document.querySelectorAll("[name='btn-category']");
  let products = [];

  //загружаем все карточки с товарами
  function start() {
    if (localStorage.getItem("products") !== null) {
      outOnPage(JSON.parse(localStorage.getItem("products")));
      localStorage.clear();
    } else {
      getProducts("all");
    }
  }
  // getProducts("all");
  start();

  //при выборе категорий будем подгружать их товары
  categoryElements.forEach((item) => {
    item.addEventListener("click", async (event) => {
      document.querySelector(".category-id").value =
        event.currentTarget.dataset.categoryId;
      await getProducts(event.currentTarget.dataset.categoryId);
    });
  });

  document
    .querySelector(".btn-search-product")
    .addEventListener("click", async (e) => {
      e.preventDefault();
      let form = document.querySelector(".filter");
      let fd = new FormData(form);
      let res = await postFormData("/app/tables/products/save.filter.php", fd);
      localStorage.setItem("products", JSON.stringify(res));
      outOnPage(res);
    });

  document.querySelector(".btn-clear-filter").addEventListener("click", () => {
    getProducts("all");
  });

  //создаём функцию для загрузки данных
  async function getProducts(categories) {
    localStorage.clear();
    //формируем параметр
    const param = new URLSearchParams();
    param.append("category", categories);
    products = await getData("/app/tables/products/search.check.php", param);

    localStorage.setItem("products", JSON.stringify(products));
    //выведим полученные данные на страницу
    outOnPage(JSON.parse(localStorage.getItem("products")));
  }

  function outOnPage(products) {
    productsConteiner.innerHTML = ``;
    let currentPage = 1;
    let rows = 4;
    function displayList(arr, rows, page) {
      productsConteiner.innerHTML = ``;
      page--;
      const start = rows * page;
      const end = start + rows;
      const paginateData = arr.slice(start, end);

      paginateData.forEach((element) => {
        let stars = showStars(element);
        productsConteiner.insertAdjacentHTML(
          "beforeend",
          createCard(element, stars)
        );
      });
    }

    function displayPagination(arr, rows) {
      pages.innerHTML = ``;
      const pagesCount = Math.ceil(arr.length / rows);

      for (let i = 0; i < pagesCount; i++) {
        const x = displayPaginationBtn(i + 1);
        pages.appendChild(x);
      }
    }

    function displayPaginationBtn(page) {
      const btn = document.createElement("button");
      btn.classList.add("btn-page");
      const p = document.createElement("p");
      p.textContent = page;
      btn.appendChild(p);

      if (currentPage == page) {
        btn.classList.add("btn-page-active");
      }

      btn.addEventListener("click", () => {
        currentPage = page;
        displayList(products, rows, currentPage);
        let currentItemBtn = document.querySelector("button.btn-page-active");
        currentItemBtn.classList.remove("btn-page-active");
        btn.classList.add("btn-page-active");
      });

      return btn;
    }

    displayList(products, rows, currentPage);
    displayPagination(products, rows);
  }

  function showStars(item) {
    let stars = "";

    let min = Math.floor(item.overall_rating);
    let round = Math.round(item.overall_rating);

    for (let i = 0; i < min; i++) {
      stars += `<img class="review-overall-star" src="/upload/icons/star.svg" alt="star">`;
    }

    if (item.overall_rating - min > item.overall_rating - round) {
      let imgName =
        item.overall_rating - min > 0.8
          ? "/upload/icons/star.svg"
          : "/upload/icons/star-half.svg";
      stars += ` <img class="review-overall-star" src="${imgName}" alt="star">`;
    }

    for ($i = 5; $i > round; $i--) {
      stars += `<img class="review-overall-star" src="/upload/icons/star-empty.svg" alt="star">`;
    }
    return stars;
  }

  //создаём карточку товара
  function createCard(
    { id, name, image, price, overall_rating, count_reviews },
    stars
  ) {
    let template = `<div class="product">
    <div class="card">
        <img src="/upload/System-Block/${image}" class="card-img" alt="${name}" />
        <div class="card-body">
            <h3 class="card-title">${name}</h3>
            <h3 class="card-text">Цена ${Math.round(price)}₽</h3>
            <div class="review-product">
              <div class="product-stars">${stars}</div>
              <p>(${count_reviews})</p>
            </div>
        </div>
        <input type="hidden" class="p-overall_rating" value="${overall_rating}">
        <div class="more">
            <form action="/app/tables/products/show.php" method="POST">
              <input type="hidden" name="id" value="${id}">
              <button name="btn-more" class="btn-more"><p>Подробнее</p></button>
            </form>`;
    if (window.temp == 1) {
      template += `<div class="div-card-btn">
      <img class="btn-basket" id="btn-${id}" data-btn-id="${id}" src="/upload/icons/basket-black.svg" alt="basket"/>
      </div>
    </div>
    </div>
  </div>`;
    } else {
      template += `<div class="div-card-btn">
      <img class="btn-basket-no-auth" id="btn-${id}" data-btn-id="${id}" src="/upload/icons/basket-black.svg" alt="basket"/>
      </div>
    </div>
    </div>
  </div>`;
    }
    return template;
  }

  let modalWrapper = document.querySelector(".modal-wrapper");
  let modal = document.querySelector(".modal");

  document.addEventListener("click", async (event) => {
    if (event.target.classList.contains("btn-basket")) {
      let id = event.target.dataset.btnId;
      await postJSON("/app/tables/basket/save.basket.php", id, "add").then(
        function (value) {
          let count = document.querySelector(".count_all");
          count.textContent = value.totalCount;
        }
      );
    }
    if (event.target.classList.contains("btn-basket-no-auth")) {
      event.preventDefault();
      modalWrapper.style.display = "block";
      modal.style.display = "block";
    }
  });
});
