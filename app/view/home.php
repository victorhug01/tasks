<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tasks/database/connection.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php
        $query = $mysqli->query("SELECT * FROM `list` ORDER BY `id_list` ASC");
        $count = 1;
        while ($fetch = $query->fetch_array()) {
            ?>
            <div class="bg-primary row align-items-center rounded my-1 p-1  ">
                <div class="col d-flex text-left align-items-center justify-content-start">
                    <?php
                    if (!empty($fetch['image_product'])) {
                        $imageData = base64_encode($fetch['image_product']);

                        echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="imagem produto" style="height: auto; width: 6vw;" class="rounded">';
                    } else {
                        echo '<img src="public/images/bag.png" alt="imagem produto" style="height: auto; width: 6vw;" class="rounded">';
                    }
                    ?>
                    <div class="px-2 text-left">
                        <h4><?php echo $fetch['title'] ?></h4>
                        <?php echo ($fetch['optional']) == 'on' ? 'Item Opcional' : 'Obrigatório⚠' ?>
                    </div>
                </div>
                <div class="col d-grid">
                    <div class="d-grid text-left text-center row">
                        <h5>Descrição</h5>
                        <p class="d-inline-block text-truncate col"><?php echo $fetch['descriptions'] ?></p>
                    </div>
                </div>
                <div class="col d-grid">
                    <div class="d-flex justify-content-around col">
                        <div class="d-grid justify-content-center text-center row">
                            <h5>Horário </h5>
                            <p><?php echo $fetch['time_shopping'] ?></p>
                        </div>
                        <div class="d-grid justify-content-center text-center row">
                            <h5>Data </h5>
                            <p><?php echo $fetch['date_shopping'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <?php
                    if ($fetch['status'] != "Done") {
                        echo
                            '<a href="app/view/update.php?task_id=' . $fetch['id_list'] . '" class="btn btn-success w-25"><span class="glyphicon glyphicon-check">✔</span></a>';
                    }
                    ?>
                    <a href="app/view/delete.php?task_id=<?php echo $fetch['id_list'] ?>" class="btn btn-danger w-25">
                        <span class="glyphicon glyphicon-remove">❌</span>
                    </a>

                </div>
            </div>
            <?php
        }
        ?>
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
                    <form action="index.php?p=add" method="POST" class="container" enctype="multipart/form-data">
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
                                placeholder="Maximo de 10 palavras" maxlength="500" rows="5">
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
                            <button type="submit" name="add" data-bs-dismiss="modal"
                                class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>