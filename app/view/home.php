<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include $_SERVER['DOCUMENT_ROOT'] . '/tasks/database/connection.php';


if (isset($_POST['insert'])) {

    $title = mysqli_real_escape_string($mysqli, $_POST['title']);
    $date = mysqli_real_escape_string($mysqli, $_POST['date']);
    $time = mysqli_real_escape_string($mysqli, $_POST['time']);
    $selectOption = mysqli_real_escape_string($mysqli, $_POST['select-option']);
    $chooseFile = mysqli_real_escape_string($mysqli, $_POST['choose-file']);
    $description = mysqli_real_escape_string($mysqli, $_POST['description']);
    $optional = mysqli_real_escape_string($mysqli, $_POST['optional']);

    print_r($_SESSION['userData']['id_user']);

    $queryInsert = "INSERT INTO list(
            title, 
            time_shopping, 
            date_shopping, 
            descriptions, 
            image_product,
            option_size,
            optional, 
            fk_id_user) 
        VALUES (
            '{$title}',
            '{$time}',
            '{$date}',
            '{$description}',
            '{$chooseFile}',
            '{$selectOption}',
            '{$optional}',
            '{$_SESSION['userData']['id_user']}'
        )";

    $resultInsert = mysqli_query($mysqli, $queryInsert) or die(mysqli_error($mysqli));

    $userId = $_SESSION['userData']['id_user'];
    $querySelect = "SELECT * FROM list WHERE fk_id_user = {$userId}";
    $resultSelect = mysqli_query($mysqli, $querySelect) or die('Erro na query');
    $dataList = mysqli_fetch_assoc($resultSelect);
    $_SESSION['userList'] = $dataList;
    print_r($_SESSION['userList']);

}
?>


<!DOCTYPE html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/language.php' ?>

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/header.php' ?>
    <title>Home</title>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/navbar.php' ?>
    <section class="w-100 p-3" style="height: calc(100vh - 100px);">
        <span>Bem vindo(a), <?php print_r($_SESSION['userData']['nome']); ?>.</span>
        <span>Bem vindo(a), <?php print_r($_SESSION['userList']); ?>.</span>
        <!-- <div class="w-100 bg-primary" style="height: 4vh;"></div> -->
    </section>
    <button type="button" class="btn btn-primary rounded-circle fw-bold position-absolute bottom-0 end-0 m-3"
        style="height: 50px; width: 50px;" data-bs-toggle="modal" data-bs-target="#exampleModal"
        data-bs-whatever="@mdo">+</button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="container ">
                        <div class="form-group d-grid gap-2">
                            <label for="">Título</label>
                            <input type="text" name="title" class="form-control border border-2 border-dark">
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for="">Hora</label>
                            <input type="time" name="time" class="form-control border border-2 border-dark">
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for="">Data</label>
                            <input type="date" name="date" class="form-control border border-2 border-dark">
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for=""></label>
                            <select class="form-select d-grid gap-2 border border-2 border-dark" name="select-option">
                                <option selected>Selecione uma opção</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group d-grid gap-2 mb-3 py-3">
                            <input name="choose-file" class="form-control form-control-sm border border-2 border-dark"
                                id="formFileSm" type="file">
                        </div>
                        <div class="form-group d-grid gap-2 mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                            <textarea name="description" class="form-control border border-2 border-dark"
                                id="exampleFormControlTextarea1" style="resize:none;"
                                placeholder="Maximo de 500 palavras" maxlength="500" rows="5">
                            </textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border border-2 border-dark" name="optional" type="checkbox"
                                id="flexCheckDisabled">
                            <label class="form-check-label" for="flexCheckDisabled">
                                Item opcional?
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" name="insert" data-bs-dismiss="modal"
                                class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>