<!DOCTYPE html>
<?php include '../elements/language.php' ?>

<head>
    <?php include '../elements/header.php' ?>
    <title>Add</title>
</head>

<body>
    <section class="vh-100 w-100 align-items-center justify-content-center">
        <?php include '../elements/navbar.php' ?>
        <form action="" method="post" class="container d-grid gap-2 col-xl-6 col-lg-6">
            <div class="form-group d-grid gap-2">
                <label for="">Título</label>
                <input type="text" class="form-control border border-2 border-dark">
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
                <input class="form-control form-control-sm border border-2 border-dark" id="formFileSm" type="file">
            </div>
            <div class="form-group d-grid gap-2 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                <textarea class="form-control border border-2 border-dark" id="exampleFormControlTextarea1"
                    style="resize:none;" placeholder="Maximo de 500 palavras" maxlength="500" rows="5" >
                </textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input border border-2 border-dark" type="checkbox" value=""
                    id="flexCheckDisabled">
                <label class="form-check-label" for="flexCheckDisabled">
                    Item opcional?
                </label>
            </div>
            <div class="form-group d-flex justify-content-center p-4">
                <button type="button" class="btn btn-primary">Adicionar</button>
            </div>
        </form>

    </section>
</body>
</html>