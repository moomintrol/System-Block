//получение данных
async function getData(route, params = "") {
  if (params != "") {
    route += `?${params}`;
  }
  let response = await fetch(route);
  return await response.json();
}

//передача данных в формате json
async function postJSON(route, data, action) {
  let response = await fetch(route, {
    method: "POST",
    headers: {
      //этот заголовок надо передавать обязательно, если тело в формате json
      "Content-Type": "application/json;charset=UTF-8",
    },
    body: JSON.stringify({ data, action }),
  });

  return await response.json();
}
