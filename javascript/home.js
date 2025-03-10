function closeAndClear() {
  form = document.getElementById("formPost");
  form.reset();
}

function swalAdd() {
  form = document.getElementById("formPost");
  if (form.reportValidity()) {
    Swal.fire({
      title: "Você deseja criar esse item?",
      showDenyButton: true,
      confirmButtonText: "Confirmar",
      confirmButtonColor: "#3085d6",
      denyButtonText: `cancelar`,
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      } else if (result.isDenied) {
        Swal.fire("Item não criado", "", "error");
      }
    });
  }
}

function markList(index) {
  console.log(index);
  Swal.fire({
    title: "VoCê já pegou esse item?",
    showDenyButton: true,
    confirmButtonText: "Conferir",
    confirmButtonColor: "#3085d6",
    denyButtonText: `cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = `app/view/update.php?task_id=${index}`;
    } else if (result.isDenied) {
      Swal.fire("Item não conferido", "", "error");
    }
  });
}

function removeList(index) {
  Swal.fire({
    title: "Remover item da lista",
    showDenyButton: true,
    confirmButtonText: "Remover",
    confirmButtonColor: "#3085d6",
    denyButtonText: `cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = `app/view/delete.php?task_id=${index}`;
    } else if (result.isDenied) {
      Swal.fire("Item não removido", "", "error");
    }
  });
}

function exitAccount() {
  Swal.fire({
    title: "Deseja sair de sua conta?",
    showDenyButton: true,
    confirmButtonText: "Confirmar",
    confirmButtonColor: "#3085d6",
    denyButtonText: `cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = `index.php?p=logout`;
    } else if (result.isDenied) {
      Swal.fire("VocÊ não saiu de sua conta", "", "error");
    }
  });
}
