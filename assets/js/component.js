document.addEventListener("DOMContentLoaded", () => {
  let itcSliderItem = document.querySelectorAll(".itc-slider__item");
  itcSliderItem.forEach((item) => {
    item.addEventListener("mouseenter", () => {
      let btn = document.createElement("button");
      btn.class = "btn-component";
      btn.innerHTML = `<p>Подробнее</p>`;
      item.append(btn);
    });
    item.addEventListener("mouseleave", () => {
      document.querySelectorAll(".btn-component").remove();
    });
  });
});
