function delete_confirm_product() {
  if (confirm("Tem certeza de que deseja excluir este produto?")) {
    return true;
  } else {
    return false;
  }
}

function delete_confirm_client() {
  if (confirm("Tem certeza de que deseja excluir este cliente?")) {
    return true;
  } else {
    return false;
  }
}

function delete_confirm_sell() {
  if (confirm("Tem certeza de que deseja apagar esta venda?")) {
    return true;
  } else {
    return false;
  }
}

function delete_confirm_cancel() {
  if (confirm("Tem certeza de que deseja cancelar a venda?")) {
    return true;
  } else {
    return false;
  }
}

function i_dont_know(){
  location.reload(true);
  setTimeout(window.open('/pagamento/abrir'), 5000);
}
