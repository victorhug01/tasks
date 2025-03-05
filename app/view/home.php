<h1?php
?>

<!DOCTYPE html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/language.php' ?>

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/header.php' ?>
    <title>Home</title>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/navbar.php' ?>
    <section class="w-100 p-3"
        style="height: calc(100vh - 100px);">
        <span>Bem vindo(a), <?php print_r($_SESSION['userData']['nome']);?>.</span>
    </section>
    <button type="button" class="btn btn-primary rounded-circle fw-bold position-absolute bottom-0 end-0 m-3"
        style="height: 50px; width: 50px;" data-bs-toggle="modal" data-bs-target="#exampleModal"
        data-bs-whatever="@mdo">+</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="container ">
                        <div class="form-group d-grid gap-2">
                            <label for="">Título</label>
                            <input type="text" class="form-control border border-2 border-dark" required>
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for="">Hora</label>
                            <input type="time" class="form-control border border-2 border-dark">
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for="">Data</label>
                            <input type="date" class="form-control border border-2 border-dark">
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for=""></label>
                            <select class="form-select d-grid gap-2 border border-2 border-dark">
                                <option selected>Selecione uma opção</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group d-grid gap-2 mb-3 py-3">
                            <input class="form-control form-control-sm border border-2 border-dark" id="formFileSm"
                                type="file">
                        </div>
                        <div class="form-group d-grid gap-2 mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                            <textarea class="form-control border border-2 border-dark" id="exampleFormControlTextarea1"
                                style="resize:none;" placeholder="Maximo de 500 palavras" maxlength="500" rows="5" required>
                            </textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border border-2 border-dark" type="checkbox" value=""
                                id="flexCheckDisabled" required>
                            <label class="form-check-label" for="flexCheckDisabled">
                                Item opcional?
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>