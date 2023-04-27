$(function () {
  $("#from").datepicker({
    changeMonth: true,
    numberOfMonths: 1,
    minDate: 0, // 20 дней назад - минимальная дата
    maxDate: 60,
  });
});
